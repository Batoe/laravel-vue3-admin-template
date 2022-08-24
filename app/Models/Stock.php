<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends CommonModel {
    use SoftDeletes;

    protected $table = 'stock';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function product() {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }

    public function warehouse() {
        return $this->hasOne(Warehouses::class, 'id', 'warehouse_id');
    }
}