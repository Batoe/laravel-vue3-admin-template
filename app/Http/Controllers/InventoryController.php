<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Warehousing;
use Illuminate\Support\Facades\DB;
use App\Models\Outbound;
use App\Models\Stock;

class InventoryController extends Controller
{

    /**
     * 保存入库单
     */
    public function saveWarehousing()
    {
        $form = request('form');
        $manager = get_manager_id();

        if (!(isset($form['company_id']) && $form['company_id'])) {
            return response(['code' => 503, 'message' => '请输入正确的供货单位']);
        }
        if (!(isset($form['warehouse_id']) && $form['warehouse_id'])) {
            return response(['code' => 503, 'message' => '请输入正确的仓库']);
        }

        DB::beginTransaction();
        if ($form['id']) {
            $warehousing = Warehousing::find($form['id']);
            if (!$warehousing) {
                return response(['code' => 503, 'message' => '不存在的入库单']);
            }
            Warehousing::resetStock($form['id']);
            $warehousing->detail()->delete();
            $warehousing->updater = $manager;
        } else {
            $warehousing = new Warehousing();
            $warehousing->creater = $manager;
        }
        $warehousing->code = $form['code'];
        $warehousing->warehousing_time = $form['warehousing_time'];
        $warehousing->company_id = $form['company_id'];
        $warehousing->warehouse_id = $form['warehouse_id'];
        $warehousing->remark = $form['remark'];
        $warehousing->purchase_code = $form['purchase_code'];
        $warehousing->save();

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
                'warehousing_id' => $warehousing->id,
                'product_id' => $row['product_id'],
                'product_name' => $product->name,
                'num' => $row['num'],
                'unit' => $product->unit,
                'price' => $row['price'],
                'money' => $row['price'] * $row['num']
            ];
        }
        $warehousing->detail()->createMany($list);
        DB::commit();
        Warehousing::AddStock($warehousing->id);

        if ($form['id'])
            clog('修改', $warehousing, '修改入库单');
        else
            clog('新增', $warehousing, '新增入库单');

        return response(['code' => 200, 'message' => '保存成功']);
    }

    /**
     * 删除入库单
     */
    public function deleteWarehousing($code)
    {
        $warehousing = Warehousing::where('code', $code)->first();

        if (!$warehousing) {
            return response(['code' => 503, 'message' => '不存在或已删除的的入库单 ' . $code]);
        }
        if ($warehousing->status == 1) {
            return response(['code' => 503, 'message' => '入库单 ' . $warehousing->code . ' 已审核']);
        }

        Warehousing::resetStock($warehousing->id);
        $warehousing->detail()->delete();
        $warehousing->delete();

        clog('删除', $warehousing, '删除入库单');

        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 获取入库单
     */
    public function getWarehousing($code)
    {
        $warehousing = Warehousing::with(['createrManager', 'updaterManager', 'auditerManager'])->where('code', $code)->first();

        if (!$warehousing) {
            return response(['code' => 503, 'message' => '不存在的入库单']);
        }

        $warehousing->list = $warehousing->detail;
        unset($warehousing->detail);
        return response(['code' => 200, 'data' => $warehousing]);
    }

    /**
     * 入库单列表
     */
    public function getWarehousingList()
    {
        $listQuery = request('listQuery');
        $listQuery = (array) @json_decode($listQuery);

        $list = Warehousing::with(['company', 'warehouse', 'createrManager', 'updaterManager', 'auditerManager'])
            ->where(function ($query) use ($listQuery) {
                $query->when(count($listQuery['date'] ?? []), function ($query) use ($listQuery) {
                    $date = [$listQuery['date'][0] . ' 00:00:00', $listQuery['date'][1] . ' 23:59:59'];
                    $query->whereBetween('warehousing.warehousing_time', $date);
                })
                    ->when($listQuery['code'], function ($query) use ($listQuery) {
                        $query->where('code', 'like', '%' . $listQuery['code'] . '%');
                    })
                    ->when(count($listQuery['warehouse']), function ($query) use ($listQuery) {
                        $query->whereIn('warehouse_id', $listQuery['warehouse']);
                    })
                    ->when(count($listQuery['company']), function ($query) use ($listQuery) {
                        $query->whereIn('company_id', $listQuery['company']);
                    })
                    ->when($listQuery['purchase_code'], function ($query) use ($listQuery) {
                        $query->where('purchase_code', 'like', '%' . $listQuery['purchase_code'] . '%');
                    })
                    ->when($listQuery['remark'], function ($query) use ($listQuery) {
                        $query->where('remark', 'like', '%' . $listQuery['remark'] . '%');
                    })
                    ->when($listQuery['product'], function ($query) use ($listQuery) {
                        $query->whereIn('wd.product_id', $listQuery['product']);
                    })
                    ->when($listQuery['status'] != '', function ($query) use ($listQuery) {
                        $query->where('status', $listQuery['status']);
                    });
            })
            ->join('warehousing_detail as wd', 'wd.warehousing_id', '=', 'warehousing.id', 'left')
            ->where('wd.deleted_at')
            ->select('warehousing.id', 'code', 'status', 'warehouse_id', 'warehousing_time', 'purchase_code', 'company_id', 'creater', 'updater', 'auditer', 'warehousing.created_at', 'warehousing.updated_at', 'wd.product_name', 'wd.unit', 'wd.num', 'wd.price', 'wd.money');

        $total = $list->count();

        $list = $list->offset(($listQuery['page'] - 1) * $listQuery['limit'])
            ->limit($listQuery['limit'])
            ->get();

        return response(['code' => 200, 'data' => $list, 'total' => $total]);
    }

    /**
     * 入库单审核
     */
    public function auditWarehousing($code)
    {
        $manager = get_manager_id();
        $warehousing = Warehousing::where('code', $code)->first();

        if (!$warehousing) {
            return response(['code' => 503, 'message' => '不存在的入库单']);
        }
        if ($warehousing->status == 1) {
            return response(['code' => 503, 'message' => '无需审核的入库单']);
        }

        $warehousing->status = 1;
        $warehousing->auditer = $manager;
        $warehousing->save();

        clog('审核', $warehousing, '审核入库单');

        return response(['code' => 200, 'message' => '审核成功']);
    }

    /**
     * 入库单反审
     */
    public function cancelAuditWarehousing($code)
    {
        $warehousing = Warehousing::where('code', $code)->first();

        if (!$warehousing) {
            return response(['code' => 503, 'message' => '不存在的入库单']);
        }
        if ($warehousing->status == 0) {
            return response(['code' => 503, 'message' => '无需反审的入库单']);
        }

        $warehousing->status = 0;
        $warehousing->save();

        clog('反审', $warehousing, '反审入库单');
        return response(['code' => 200, 'message' => '反审成功']);
    }

    /**
     * 批量删除入库单
     */
    public function batchDeleteWarehousing()
    {
        $code = request('code');
        if (!is_array($code)) {
            return response(['code' => 503, 'message' => '不存在的入库单']);
        }
        DB::beginTransaction();
        foreach ($code as $c) {
            $res = $this->deleteWarehousing($c)->getContent();
            if (json_decode($res)->code != 200) {
                DB::rollBack();
                return $res;
            }
        }
        DB::commit();
        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 批量审核
     */
    public function batchAuditWarehousing()
    {
        $code = request('code');
        if (!is_array($code)) {
            return response(['code' => 503, 'message' => '不存在的入库单']);
        }
        DB::beginTransaction();
        foreach ($code as $c) {
            $res = $this->auditWarehousing($c)->getContent();
            if (json_decode($res)->code != 200) {
                DB::rollBack();
                return $res;
            }
        }
        DB::commit();
        return response(['code' => 200, 'message' => '审核成功']);
    }

    // =================================================================================================================================================== //

    /**
     * 保存出库单
     */
    public function saveOutbound()
    {
        $form = request('form');
        $manager = get_manager_id();

        DB::beginTransaction();
        if ($form['id']) {
            $outbound = Outbound::find($form['id']);
            if (!$outbound) {
                return response(['code' => 503, 'message' => '不存在的出库单']);
            }
            Outbound::resetStock($form['id']);
            $outbound->detail()->delete();
            $outbound->updater = $manager;
        } else {
            $outbound = new Outbound();
            $outbound->creater = $manager;
        }
        $outbound->code = $form['code'];
        $outbound->outbound_time = $form['outbound_time'];
        $outbound->company_id = $form['company_id'];
        $outbound->warehouse_id = $form['warehouse_id'];
        $outbound->remark = $form['remark'];
        $outbound->sale_code = $form['sale_code'];
        $outbound->save();

        $list = [];
        if (!is_array($form['list'])) {
            DB::rollBack();
            return response(['code' => 503, 'message' => '表格不正确']);
        }
        foreach ($form['list'] as $key => $row) {
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
                'outbound_id' => $outbound->id,
                'product_id' => $row['product_id'],
                'product_name' => $product->name,
                'num' => $row['num'],
                'unit' => $product->unit,
                'price' => $row['price'],
                'money' => $row['price'] * $row['num']
            ];
        }
        $outbound->detail()->createMany($list);
        DB::commit();
        Outbound::AddStock($outbound->id);

        if ($form['id'])
            clog('修改', $outbound, '修改出库单');
        else
            clog('新增', $outbound, '新增出库单');

        return response(['code' => 200, 'message' => '保存成功']);
    }

    /**
     * 删除出库单
     */
    public function deleteOutbound($code)
    {
        $outbound = Outbound::where('code', $code)->first();

        if (!$outbound) {
            return response(['code' => 503, 'message' => '不存在或已删除的的出库单 ' . $code]);
        }
        if ($outbound->status == 1) {
            return response(['code' => 503, 'message' => '出库单 ' . $outbound->code . ' 已审核']);
        }

        Outbound::resetStock($outbound->id);
        $outbound->detail()->delete();
        $outbound->delete();

        clog('删除', $outbound, '删除出库单');

        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 获取出库单
     */
    public function getOutbound($code)
    {
        $outbound = Outbound::with(['createrManager', 'updaterManager', 'auditerManager'])->where('code', $code)->first();

        if (!$outbound) {
            return response(['code' => 503, 'message' => '不存在的出库单']);
        }

        $outbound->list = $outbound->detail;
        unset($outbound->detail);
        return response(['code' => 200, 'data' => $outbound]);
    }

    /**
     * 出库单列表
     */
    public function getOutboundList()
    {
        $listQuery = request('listQuery');
        $listQuery = (array) @json_decode($listQuery);

        $list = Outbound::with(['company', 'warehouse', 'createrManager', 'updaterManager', 'auditerManager'])
            ->where(function ($query) use ($listQuery) {
                $query->when(count($listQuery['date'] ?? []), function ($query) use ($listQuery) {
                    $date = [$listQuery['date'][0] . ' 00:00:00', $listQuery['date'][1] . ' 23:59:59'];
                    $query->whereBetween('outbound.outbound_time', $date);
                })
                    ->when($listQuery['code'], function ($query) use ($listQuery) {
                        $query->where('code', 'like', '%' . $listQuery['code'] . '%');
                    })
                    ->when(count($listQuery['warehouse']), function ($query) use ($listQuery) {
                        $query->whereIn('warehouse_id', $listQuery['warehouse']);
                    })
                    ->when(count($listQuery['company']), function ($query) use ($listQuery) {
                        $query->whereIn('company_id', $listQuery['company']);
                    })
                    ->when($listQuery['sale_code'], function ($query) use ($listQuery) {
                        $query->where('sale_code', 'like', '%' . $listQuery['sale_code'] . '%');
                    })
                    ->when($listQuery['remark'], function ($query) use ($listQuery) {
                        $query->where('remark', 'like', '%' . $listQuery['remark'] . '%');
                    })
                    ->when($listQuery['product'], function ($query) use ($listQuery) {
                        $query->whereIn('od.product_id', $listQuery['product']);
                    })
                    ->when($listQuery['status'] != '', function ($query) use ($listQuery) {
                        $query->where('status', $listQuery['status']);
                    });
            })
            ->join('outbound_detail as od', 'od.outbound_id', '=', 'outbound.id', 'left')
            ->where('od.deleted_at')
            ->select('outbound.id', 'code', 'status', 'warehouse_id', 'outbound_time', 'sale_code', 'company_id', 'creater', 'updater', 'auditer', 'outbound.created_at', 'outbound.updated_at', 'od.product_name', 'od.unit', 'od.num', 'od.price', 'od.money');

        $total = $list->count();

        $list = $list->offset(($listQuery['page'] - 1) * $listQuery['limit'])
            ->limit($listQuery['limit'])
            ->get();

        return response(['code' => 200, 'data' => $list, 'total' => $total]);
    }

    /**
     * 出库单审核
     */
    public function auditOutbound($code)
    {
        $manager = get_manager_id();
        $outbound = Outbound::where('code', $code)->first();

        if (!$outbound) {
            return response(['code' => 503, 'message' => '不存在的出库单']);
        }
        if ($outbound->status == 1) {
            return response(['code' => 503, 'message' => '无需审核的出库单']);
        }

        $outbound->status = 1;
        $outbound->auditer = $manager;
        $outbound->save();

        clog('审核', $outbound, '审核出库单');

        return response(['code' => 200, 'message' => '审核成功']);
    }

    /**
     * 出库单反审
     */
    public function cancelAuditOutbound($code)
    {
        $outbound = Outbound::where('code', $code)->first();

        if (!$outbound) {
            return response(['code' => 503, 'message' => '不存在的出库单']);
        }
        if ($outbound->status == 0) {
            return response(['code' => 503, 'message' => '无需反审的出库单']);
        }

        $outbound->status = 0;
        $outbound->save();

        clog('反审', $outbound, '反审出库单');

        return response(['code' => 200, 'message' => '反审成功']);
    }

    /**
     * 批量删除出库单
     */
    public function batchDeleteOutbound()
    {
        $code = request('code');
        if (!is_array($code)) {
            return response(['code' => 503, 'message' => '不存在的出库单']);
        }
        DB::beginTransaction();
        foreach ($code as $c) {
            $res = $this->deleteOutbound($c)->getContent();
            if (json_decode($res)->code != 200) {
                DB::rollBack();
                return $res;
            }
        }
        DB::commit();
        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 批量审核
     */
    public function batchAuditOutbound()
    {
        $code = request('code');
        if (!is_array($code)) {
            return response(['code' => 503, 'message' => '不存在的出库单']);
        }
        DB::beginTransaction();
        foreach ($code as $c) {
            $res = $this->auditOutbound($c)->getContent();
            if (json_decode($res)->code != 200) {
                DB::rollBack();
                return $res;
            }
        }
        DB::commit();
        return response(['code' => 200, 'message' => '审核成功']);
    }

    // ========================================================================================================================= //

    /*
     *  库存整理
     */
    public function finishing()
    {
        $list = [];
        $warehousing_list = Warehousing::all();
        foreach ($warehousing_list as $warehousing) {
            if (isset($list[$warehousing->warehouse_id]) && $tmp = $list[$warehousing->warehouse_id]) {
                foreach ($warehousing->detail as $detail) {
                    $in = false;
                    foreach ($tmp as $k => $t) {
                        if ($detail->product_id == $t['product_id']) $in = $k;
                    }
                    if (!is_numeric($in)) {
                        $tmp[] = [
                            'product_id' => $detail->product_id,
                            'num' => $detail->num
                        ];
                    } else {
                        $tmp[$in]['num'] += $detail->num;
                    }
                }
            } else {
                $tmp = [];
                foreach ($warehousing->detail as $detail) {
                    $in = false;
                    foreach ($tmp as $k => $t) {
                        if ($detail->product_id == $t['product_id']) $in = $k;
                    }
                    if (!is_numeric($in)) {
                        $tmp[] = [
                            'product_id' => $detail->product_id,
                            'num' => $detail->num
                        ];
                    } else {
                        $tmp[$in]['num'] += $detail->num;
                    }
                }
            }
            $list[$warehousing->warehouse_id] = $tmp;
        }

        $outbound_list = Outbound::all();
        foreach ($outbound_list as $outbound) {
            if (isset($list[$outbound->warehouse_id]) && $tmp = $list[$outbound->warehouse_id]) {
                foreach ($outbound->detail as $detail) {
                    $in = false;
                    foreach ($tmp as $k => $t) {
                        if ($detail->product_id == $t['product_id']) $in = $k;
                    }
                    if (!is_numeric($in)) {
                        $tmp[] = [
                            'product_id' => $detail->product_id,
                            'num' => -1 * $detail->num
                        ];
                    } else {
                        $tmp[$in]['num'] -= $detail->num;
                    }
                }
            } else {
                $tmp = [];
                foreach ($outbound->detail as $detail) {
                    $in = false;
                    foreach ($tmp as $k => $t) {
                        if ($detail->product_id == $t['product_id']) $in = $k;
                    }
                    if (!is_numeric($in)) {
                        $tmp[] = [
                            'product_id' => $detail->product_id,
                            'num' => -1 * $detail->num
                        ];
                    } else {
                        $tmp[$in]['num'] -= $detail->num;
                    }
                }
            }
            $list[$outbound->warehouse_id] = $tmp;
        }

        foreach ($list as $warehouse_id => $products) {
            foreach ($products as $product) {
                $stock = Stock::where('warehouse_id', $warehouse_id)->where('product_id', $product['product_id'])->first();
                $stock->num = $product['num'];
                $stock->save();
            }
        }

        clog('修改', 'stock', '整理库存量');

        return response(['code' => 200, 'message' => '整理成功']);
    }

    /**
     * 库存数量
     */
    public function getInventory()
    {
        $form = request()->only(['product', 'warehouse', 'page', 'limit']);

        $list = Stock::with(['warehouse', 'product'])->where(function ($query) use ($form) {
            $query->when(is_array($form['product']) && count($form['product']), function ($query) use ($form) {
                $query->whereIn('product_id', $form['product']);
            })->when(is_array($form['warehouse']) && count($form['warehouse']), function ($query) use ($form) {
                $query->whereIn('warehouse_id', $form['warehouse']);
            });
        });
        $total = $list->count();
        $list = $list->offset(($form['page'] - 1) * $form['limit'])
            ->limit($form['limit'])
            ->get();

        return response(['code' => 200, 'data' => $list, 'total' => $total]);
    }
}
