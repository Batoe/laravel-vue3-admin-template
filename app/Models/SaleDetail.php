<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends CommonModel {
    use SoftDeletes;

    protected $table = 'sale_detail';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'sale_id',
        'product_id',
        'product_name',
        'num',
        'unit',
        'price',
        'money'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'id', 'sale_id');
    }

    public function product() {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}