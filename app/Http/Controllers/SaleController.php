<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Sale;
use App\Models\Statement;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller {

    /**
     * 保存销售单
     */
    public function saveSale() {
        $form = request('form');
        $manager = get_manager_id();

        if (!$form['code']) {
            return response(['code' => 503, 'message' => '输入正确的销售单号']);
        }
        if (!$form['company']) {
            return response(['code' => 503, 'message' => '输入正确的销货单位']);
        }

        DB::beginTransaction();
        if ($form['id']) {
            $sale = Sale::find($form['id']);
            if (!$sale) {
                return response(['code' => 503, 'message' => '不存在的销售单']);
            }
            $sale->updater = $manager;
            $sale->detail()->delete();
        } else {
            $sale = new Sale();
            $sale->creater = $manager;
        }

        $sale->code = $form['code'];
        $sale->company = intval($form['company']);
        $sale->sale_time = $form['sale_time'];
        $sale->remark = $form['remark'];
        $sale->save();

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
        $sale->detail()->createMany($list);
        DB::commit();

        if ($form['id'])
            clog('修改', $sale, '修改销售单');
        else
            clog('新增', $sale, '新增销售单');

        return response(['code' => 200, 'message' => '保存成功']);
    }

    /**
     * 获取销售单
     */
    public function getSale($code) {
        $code = request('code');

        $sale = Sale::with(['createrManager', 'updaterManager'])->where('code', $code)->first();
        if (!$sale) {
            return response(['code' => 503, 'message' => '不存在的销售单']);
        }

        $sale->list = $sale->detail;
        unset($sale->detail);
        return response(['code' => 200, 'data' => $sale]);
    }

    /**
     * 删除销售单
     */
    public function deleteSale($code)
    {
        $sale = Sale::where('code', $code)->first();

        if (!$sale) {
            return response(['code' => 503, 'message' => '不存在或已删除的的销售单 ' . $code]);
        }
        if ($sale->status == 1) {
            return response(['code' => 503, 'message' => '销售单 ' . $sale->code . ' 已审核']);
        }

        $sale->detail()->delete();
        $sale->delete();

        clog('删除', $sale, '删除销售单');

        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 销售单列表
     */
    public function getSaleList()
    {
        $listQuery = request('listQuery');
        $listQuery = (array) @json_decode($listQuery);

        $list = Sale::with(['createrManager', 'updaterManager', 'company'])
            ->where(function ($query) use ($listQuery) {
                $query->when(is_array($listQuery['date']) && count($listQuery['date']), function ($query) use ($listQuery) {
                    $date = [
                        $listQuery['date'][0] . ' 00:00:00',
                        $listQuery['date'][1] . ' 23:59:59'
                    ];
                    $query->whereBetween('sale_time', $date);
                })
                ->when(count($listQuery['company']), function ($query) use ($listQuery) {
                    $query->whereIn('company', $listQuery['company']);
                })
                ->when(count($listQuery['product']), function ($query) use ($listQuery) {
                    $query->whereIn('sd.product_id', $listQuery['product']);
                })
                ->when($listQuery['status'], function ($query) use ($listQuery) {
                    $query->where('sale.status', $listQuery['status']);
                })
                ->when($listQuery['code'], function ($query) use ($listQuery) {
                    $query->where('code', 'like', "%" . $listQuery['code'] . "%");
                })
                ->when($listQuery['remark'], function ($query) use ($listQuery) {
                    $query->where('remark', 'like', "%" . $listQuery['remark'] . "%");
                });
            })
            ->join('sale_detail as sd', 'sd.sale_id', '=', 'sale.id')
            ->where('sd.deleted_at')
            ->select('sale.id', 'sale.code', 'sale.company', 'sale.sale_time','sale.remark', 'sale.status','creater', 'updater', 'auditer','sale.created_at', 'sale.updated_at', 'sd.product_name', 'sd.unit', 'sd.num', 'sd.price', 'sd.money');

        $total = $list->count();
        $list = $list->offset(($listQuery['page'] - 1) * $listQuery['limit'])->limit($listQuery['limit'])->get();

        return response(['code' => 200, 'data' => $list, 'total' => $total]);
    }

    /**
     * 批量删除
     */
    public function batchDeleteSale() {
        $code = request(['code']);

        if (!is_array($code)) {
            return request(['code' => 503, 'message' => '不正确的销售单号']);
        }
        DB::beginTransaction();
        foreach ($code as $c) {
            $res = $this->deleteSale($c)->getContent();
            if (json_decode($res)->code != 200) {
                DB::rollBack();
                return $res;
            }
        }
        DB::commit();
        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 审核销售单
     */
    public function auditSale($code) {
        $sale = Sale::where('code', $code)->first();
        if (!$code) {
            return response(['code' => 504, 'message' => '不存在的销售单 ' . $code]);
        }
        if ($sale->status == 1) {
            return response(['code' => 500, 'message' => '无需审核的销售单 ' . $code]);
        }
        $auditer = request('auditer');
        if (!is_array($auditer)) {
            return response(['code' => 505, 'message' => '不正确的审核人']);
        }

        $auditer = implode(',', $auditer);
        $sale->auditer = $auditer;
        $sale->status = 1;
        $sale->save();

        return response(['code' => 200, 'message' => '审核成功']);
    }

    /**
     * 反审销售单
     */
    public function cancelAuditSale($code) {
        $sale = Sale::where('code', $code)->first();
        if (!$code) {
            return response(['code' => 504, 'message' => '不存在的销售单 ' . $code]);
        }
        if ($sale->status == 0) {
            return response(['code' => 500, 'message' => '无需反审的销售单 ' . $code]);
        }

        $sale->auditer = null;
        $sale->status = 0;
        $sale->save();

        return response(['code' => 200, 'message' => '反审成功']);
    }

    /**
     * 批量审核
     */
    public function batchAuditSale() {
        $code = request('code');
        if (!is_array($code)) {
            return response(['code' => 500, 'message' => '不正确的销售单号']);
        }
        DB::beginTransaction();
        foreach ($code as $c) {
            $res = $this->auditSale($c)->getContent();
            if (json_decode($res)->code != 200) {
                DB::rollBack();
                return $res;
            }
        }
        DB::commit();
        return response(['code' => 200, 'message' => '审核成功']);
    }

    /**
     * 生成结算单
     */
    public function saveStatement($code) {
        $manager = get_manager_id();
        $sale = Sale::where('code', $code)->first();
        if (!$sale) {
            return response(['code' => 503, 'message' => '不存在的销售单']);
        }
        $statement = Statement::where('sale_code', $code)->orderByDesc('created_at')->first();
        if ($statement) {
            $last_statement_tiem = $statement->created_at;
        } else {
            $last_statement_tiem = '2022-01-01';
        }
        $time = [
            $last_statement_tiem, timer()
        ];

        DB::beginTransaction();
        $statement = new Statement();
        $common = new CommonController();
        $statement->code = @json_decode($common->getCode('5')->getContent())->data->code;
        $statement->statement_time = $time[1];
        $statement->sale_code = $sale->code;
        $statement->creater = $manager;
        $statement->save();

        $list = [];
        // 出库单
        $outbound = $sale->outbound->where('status', 1)->whereBetween('outbound_time', $time);
        foreach ($outbound as $item) {
            $tmp = [
                'statement_id' => $statement->id,
                'code' => $item->code,
                'type' => 4,
                'date' => $item->outbound_time,
                'auditer' => $item->auditer,
                'audite_time' => $item->updated_at,
                'product_id' => '',
                'product_name' => '',
                'num' => '',
                'unit' => '',
                'price' => '',
                'money' => ''
            ];
            foreach ($item->detail as $detail) {
                $tmp['product_id'] = $detail->product_id;
                $tmp['product_name'] = $detail->product_name;
                $tmp['num'] = $detail->num * -1;
                $tmp['unit'] = $detail->unit;
                $tmp['price'] = $detail->price;
                $tmp['money'] = $detail->money;
                $list[] = $tmp;
            }
        }
        // 入库单
        $warehousing = $sale->purchase->map(function ($query) use ($time) {
            return $query->warehousing->where('status', 1)->whereBetween('warehousing_time', $time);
        })->collapse();
        foreach ($warehousing as $item) {
            $tmp = [
                'statement_id' => $statement->id,
                'code' => $item->code,
                'type' => 3,
                'date' => $item->warehousing_time,
                'auditer' => $item->auditer,
                'audite_time' => $item->updated_at,
                'product_id' => '',
                'product_name' => '',
                'num' => '',
                'unit' => '',
                'price' => '',
                'money' => ''
            ];
            foreach ($item->detail as $detail) {
                $tmp['product_id'] = $detail->product_id;
                $tmp['product_name'] = $detail->product_name;
                $tmp['num'] = $detail->num;
                $tmp['unit'] = $detail->unit;
                $tmp['price'] = $detail->price;
                $tmp['money'] = $detail->money;
                $list[] = $tmp;
            }
        }
        if (count($list) == 0) {
            DB::rollBack();
            return response(['code' => 506, 'message' => '没有出入库记录']);
        }
        $statement->detail()->createMany($list);
        DB::commit();

        clog('新增', $statement, '新增结算单');

        return response(['code' => 200, 'message' => '结算成功']);
    }

    /**
     * 结算单列表
     */
    public function getStatementList() {
        $form = request('listQuery');
        $form = (array) @json_decode($form);

        $list = Statement::with(['createrManager'])
            ->where(function ($query) use ($form) {
                $query->when(is_array($form['date']) && count($form['date']), function ($query) use ($form) {
                    $date = [
                        $form['date'][0] . ' 00:00:00',
                        $form['date'][1] . ' 23:59:59'
                    ];
                    $query->whereBetween('statement_time', $date);
                })
                ->when($form['code'], function ($query) use ($form) {
                    $query->where('statement.code', 'like', '%' . $form['code'] . '%');
                })
                ->when($form['sale_code'], function ($query) use ($form) {
                    $query->where('sale_code', 'like', '%' . $form['sale_code'] . '%');
                });
            })
            ->join('statement_detail as sd', 'sd.statement_id', '=', 'statement.id')
            ->select('statement.code', 'sale_code','statement_time', 'creater', 'sd.code as bill_code', 'type', 'date', 'product_name', 'unit', 'num');

        $total = $list->count();
        $list = $list->offset(($form['page'] - 1) * $form['limit'])->limit($form['limit'])->get();

        return response(['code' => 200, 'data' => $list, 'total' => $total]);
    }
}