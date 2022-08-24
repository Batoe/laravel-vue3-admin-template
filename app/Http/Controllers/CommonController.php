<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Products;
use App\Models\Warehouses;
use App\Models\Coding;
use App\Models\Outbound;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Warehousing;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{

    /**
     * 上传文件
     */
    public function upload()
    {
        $file = request('file');
        if (!$file->isValid()) {
            return response(['code' => 502, 'message' => '上传失败,可能服务器空间不足,请联系系统维护人员!']);
        }

        $filename = $file->getClientOriginalName();
        $path = Storage::putFileAs('upload/' . date('Y') . '/' . date('m') . '/' . date('d'), $file, md5(time()) . '.' . $file->getClientOriginalExtension());

        return response(['code' => 200, 'path' => '/storage/' . $path, 'filename' => $filename, 'created_at' => date('Y-m-d H:i:s', time())]);
    }

    /**
     * 供货单位
     */
    public function getDelivery()
    {
        $list = Company::whereIn('type', [2, 3])->select('id', 'name')->get();
        return response(['code' => 200, 'data' => $list]);
    }

    /**
     * 销售单位
     */
    public function getCustomer()
    {
        $list = Company::whereIn('type', [1, 3])->select('id', 'name')->get();
        return response(['code' => 200, 'data' => $list]);
    }

    /**
     * 获取仓库
     */
    public function getWarehouse()
    {
        $list = Warehouses::select('id', 'name')->get();
        return response(['code' => 200, 'data' => $list]);
    }

    /**
     * 获取产品
     */
    public function getProduct()
    {
        $list = Products::select('id', 'name', 'unit', 'price')->get();
        return response(['code' => 200, 'data' => $list]);
    }

    /**
     * 生成编码
     */
    public function getCode($type = 0)
    {
        $type = $type ?: request('type');
        if (in_array($type, array_keys($this->codeType))) {
            $last = Coding::where('type', $type)->whereDate('created_at', date("Y-m-d"))->orderByDesc('id')->first();
            if ($last) {
                $code = intval(substr($last->code, -4)) + 1;
                $code = sprintf("%04.2s", $code);
            } else {
                $code = '0001';
            }
            $full_code = $this->codeType[$type] . date('Ymd') . $code;
            $coding = new Coding();
            $coding->code = $full_code;
            $coding->type = $type;
            $coding->save();
            return response(['code' => 200, 'data' => ['code' => $full_code]]);
        } else {
            return response(['code' => 200, 'data' => ['code' => '']]);
        }
    }

    /**
     * 获取关联单据
     */
    public function getRelationalBill() {
        $type = request('type');
        $code = request('code');

        if (!in_array($type, [1,2,3,4])) {
            return response(['code' => 505, 'message' => '不正确的单据类型']);
        }

        $data = [];
        if ($type == 1) {
            $sale = Sale::with(['company'])->where('code', $code)->first();
            $data = [
                'sale' => [$sale],
                'purchase' => $sale->purchase->load('company'),
                'warehousing' => $sale->purchase->map(function ($query) {
                    return $query->warehousing->load('company');
                })->collapse(),
                'outbound' => $sale->outbound->load('company'),
                'statement' => $sale->statement->load('createrManager')
            ];
        } elseif ($type == 2) {
            $purchase = Purchase::with(['company'])->where('code', $code)->first();
            $data = [
                'sale' => [$purchase->sale->load('company')],
                'purchase' => [$purchase],
                'warehousing' => $purchase->warehousing->load('company'),
                'outbound' => $purchase->sale->outbound->load('company'),
                'statement' => $purchase->sale->statement->load('createrManager')
            ];
        } elseif ($type == 3) {
            $warehousing = Warehousing::with(['company'])->where('code', $code)->first();
            $data = [
                'sale' => [$warehousing->purchase->sale->load('company')],
                'purchase' => [$warehousing->purchase->load('company')],
                'warehousing' => [$warehousing],
                'outbound' => $warehousing->purchase->outbound,
                'statement' => $warehousing->purchase->sale->statement->load('createrManager')
            ];
        } elseif ($type == 4) {
            $outbound = Outbound::with(['company'])->where('code', $code)->first();
            $data = [
                'sale' => [$outbound->sale->load('company')],
                'purchase' => $outbound->sale->purchase->load('company'),
                'warehousing' => $outbound->sale->purchase->map(function ($query) {
                    return $query->warehousing->load('company');
                })->collapse(),
                'outbound' => [$outbound],
                'statement' => $outbound->sale->statement->load('createrManager')
            ];
        }

        return response(['code' => 200, 'data' => $data]);
    }
}
