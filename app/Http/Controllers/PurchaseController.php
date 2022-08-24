<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller {

    /**
     * 保存采购单
     */
    public function savePurchase() {
        $form = request('form');
        $manager = get_manager_id();

        if (!$form['code']) {
            return response(['code' => 503, 'message' => '输入正确的采购单号']);
        }
        if (!$form['company']) {
            return response(['code' => 503, 'message' => '输入正确的供货单位']);
        }

        DB::beginTransaction();
        if ($form['id']) {
            $purchase = Purchase::find($form['id']);
            if (!$purchase) {
                return response(['code' => 503, 'message' => '不存在的采购单']);
            }
            $purchase->updater = $manager;
            $purchase->detail()->delete();
        } else {
            $purchase = new Purchase();
            $purchase->creater = $manager;
        }

        $purchase->code = $form['code'];
        $purchase->company = intval($form['company']);
        $purchase->purchase_time = $form['purchase_time'];
        $purchase->remark = $form['remark'];
        $purchase->save();

        $list = [];
        if (!is_array($form['list'])) {
            DB::rollBack();
            return response(['code' => 503, 'message' => '表格不正确']);
        }
        foreach ($form['list'] as $key => $row) {
            if (!$row['product_id'] && !$row['num']) continue;

            $product = Products::find($row['product_id']);
            if (!$product) {
                DB::rollBack();
                return response(['code' => 503, 'message' => '第' . ($key + 1) . '行产品不存在']);
            }
            if ($row['num'] <= 0) {
                DB::rollBack();
                return response(['code' => 504, 'message' => '第' . ($key + 1) . '行产品数量小于等于0']);
            }
            $list[] = [
                'product_id' => $row['product_id'],
                'product_name' => $product->name,
                'num' => $row['num'],
                'unit' => $product->unit,
                'price' => $row['price'],
                'money' => $row['price'] * $row['num']
            ];
        }
        $purchase->detail()->createMany($list);
        DB::commit();

        if ($form['id'])
            clog('修改', $purchase, '修改采购单');
        else
            clog('新增', $purchase, '新增采购单');

        return response(['code' => 200, 'message' => '保存成功']);
    }

    /**
     * 获取采购单
     */
    public function getPurchase($code) {
        $code = request('code');

        $purchase = Purchase::with(['createrManager', 'updaterManager'])->where('code', $code)->first();
        if (!$purchase) {
            return response(['code' => 503, 'message' => '不存在的采购单']);
        }

        $purchase->list = $purchase->detail;
        unset($purchase->detail);
        return response(['code' => 200, 'data' => $purchase]);
    }

    /**
     * 删除采购单
     */
    public function deletePurchase($code)
    {
        $purchase = Purchase::where('code', $code)->first();

        if (!$purchase) {
            return response(['code' => 503, 'message' => '不存在或已删除的的采购单 ' . $code]);
        }
        if ($purchase->status == 1) {
            return response(['code' => 503, 'message' => '采购单 ' . $purchase->code . ' 已审核']);
        }

        $purchase->detail()->delete();
        $purchase->delete();

        clog('删除', $purchase, '删除采购单');

        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 采购单列表
     */
    public function getPurchaseList()
    {
        $listQuery = request('listQuery');
        $listQuery = (array) @json_decode($listQuery);

        $list = Purchase::with(['createrManager', 'updaterManager', 'company'])
            ->where(function ($query) use ($listQuery) {
                $query->when(is_array($listQuery['date']) && count($listQuery['date']), function ($query) use ($listQuery) {
                    $date = [
                        $listQuery[0] . ' 00:00:00',
                        $listQuery[1] . ' 23:59:59'
                    ];
                    $query->whereBetween('purchase_time', $date);
                })
                ->when(count($listQuery['company']), function ($query) use ($listQuery) {
                    $query->whereIn('company', $listQuery['company']);
                })
                ->when(count($listQuery['product']), function ($query) use ($listQuery) {
                    $query->whereIn('pd.product_id', $listQuery['product']);
                })
                ->when($listQuery['status'], function ($query) use ($listQuery) {
                    $query->where('purchase.status', $listQuery['status']);
                })
                ->when($listQuery['sale_code'], function ($query) use ($listQuery) {
                    $query->where('sale_code', 'like', "%" . $listQuery['sale_code'] . "%");
                })
                ->when($listQuery['code'], function ($query) use ($listQuery) {
                    $query->where('code', 'like', "%" . $listQuery['code'] . "%");
                })
                ->when($listQuery['remark'], function ($query) use ($listQuery) {
                    $query->where('remark', 'like', "%" . $listQuery['remark'] . "%");
                });
            })
            ->join('purchase_detail as pd', 'pd.purchase_id', '=', 'purchase.id')
            ->where('pd.deleted_at')
            ->select('purchase.id', 'purchase.code', 'purchase.company', 'purchase.purchase_time','purchase.remark', 'purchase.status','creater', 'updater', 'auditer', 'sale_code','purchase.created_at', 'purchase.updated_at', 'pd.product_name', 'pd.unit', 'pd.num', 'pd.price', 'pd.money');

        $total = $list->count();
        $list = $list->offset(($listQuery['page'] - 1) * $listQuery['limit'])->limit($listQuery['limit'])->get();

        return response(['code' => 200, 'data' => $list, 'total' => $total]);
    }

    /**
     * 批量删除
     */
    public function batchDeletePurchase() {
        $code = request(['code']);

        if (!is_array($code)) {
            return request(['code' => 503, 'message' => '不正确的采购单号']);
        }
        DB::beginTransaction();
        foreach ($code as $c) {
            $res = $this->deletePurchase($c)->getContent();
            if (json_decode($res)->code != 200) {
                DB::rollBack();
                return $res;
            }
        }
        DB::commit();
        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 审核采购单
     */
    public function auditPurchase($code) {
        $purchase = Purchase::where('code', $code)->first();
        if (!$code) {
            return response(['code' => 504, 'message' => '不存在的采购单 ' . $code]);
        }
        if ($purchase->status == 1) {
            return response(['code' => 500, 'message' => '无需审核的采购单 ' . $code]);
        }
        $auditer = request('auditer');
        if (!is_array($auditer)) {
            return response(['code' => 505, 'message' => '不正确的审核人']);
        }

        $auditer = implode(',', $auditer);
        $purchase->auditer = $auditer;
        $purchase->status = 1;
        $purchase->save();

        return response(['code' => 200, 'message' => '审核成功']);
    }

    /**
     * 反审采购单
     */
    public function cancelAuditPurchase($code) {
        $purchase = Purchase::where('code', $code)->first();
        if (!$code) {
            return response(['code' => 504, 'message' => '不存在的采购单 ' . $code]);
        }
        if ($purchase->status == 0) {
            return response(['code' => 500, 'message' => '无需反审的采购单 ' . $code]);
        }

        $purchase->auditer = null;
        $purchase->status = 0;
        $purchase->save();

        return response(['code' => 200, 'message' => '反审成功']);
    }

    /**
     * 批量审核
     */
    public function batchAuditPurchase() {
        $code = request('code');
        if (!is_array($code)) {
            return response(['code' => 500, 'message' => '不正确的采购单号']);
        }
        DB::beginTransaction();
        foreach ($code as $c) {
            $res = $this->auditPurchase($c)->getContent();
            if (json_decode($res)->code != 200) {
                DB::rollBack();
                return $res;
            }
        }
        DB::commit();
        return response(['code' => 200, 'message' => '审核成功']);
    }
}