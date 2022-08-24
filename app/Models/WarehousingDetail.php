<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehousingDetail extends CommonModel {
    use SoftDeletes;

    protected $table = 'warehousing_detail';

    protected $fillable = [
        'warehousing_id',
        'product_id',
        'product_name',
        'num',
        'unit',
        'price',
        'money'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function warehousing () {
        return $this->hasOne(WarehousingDetail::class, 'id', 'warehousing_id');
    }

    public function product () {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}