<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehousing extends CommonModel {
    use SoftDeletes;

    protected $table = 'warehousing';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function warehouse() {
        return $this->hasOne(Warehouses::class, 'id', 'warehouse_id')->select('id', 'name');
    }

    public function company() {
        return $this->hasOne(Company::class, 'id', 'company_id')->select('id', 'name');
    }

    public function detail() {
        return $this->hasMany(WarehousingDetail::class, 'warehousing_id', 'id');
    }

    public function createrManager() {
        return $this->hasOne(Managers::class, 'id', 'creater')->select('id', 'username');
    }

    public function updaterManager() {
        return $this->hasOne(Managers::class, 'id', 'updater')->select('id', 'username');
    }

    public function auditerManager() {
        return $this->hasOne(Managers::class, 'id', 'auditer')->select('id', 'username');
    }

    public function purchase() {
        return $this->belongsTo(Purchase::class, 'purchase_code', 'code');
    }

    /**
     * 清除可用量
     */
    public static function resetStock($warehousing_id) {
        $warehousing = self::find($warehousing_id);
        foreach ($warehousing->detail as $row) {
            $product_stock = Stock::where('product_id', $row->product_id)->where('warehouse_id', $warehousing->warehouse_id)->first();
            if ($product_stock) {
                $product_stock->num = $product_stock->num - $row->num;
            }
            $product_stock->save();
        }
    }

    /**
     * 添加可用量
     */
    public static function AddStock($warehousing_id) {
        $warehousing = self::find($warehousing_id);
        foreach ($warehousing->detail as $row) {
            $product_stock = Stock::where('product_id', $row->product_id)->where('warehouse_id', $warehousing->warehouse_id)->first();
            if ($product_stock) {
                $product_stock->num = $product_stock->num + $row->num;
            }
            $product_stock->save();
        }
    }
}