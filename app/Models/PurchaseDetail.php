<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetail extends CommonModel {
    use SoftDeletes;

    protected $table = 'purchase_detail';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'purchase_id',
        'product_id',
        'product_name',
        'num',
        'unit',
        'price',
        'money'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'id', 'purchase_id');
    }

    public function product() {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}