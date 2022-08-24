<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutboundDetail extends CommonModel {
    use SoftDeletes;

    protected $table = 'outbound_detail';

    protected $fillable = [
        'outbound_id',
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

    public function outbound () {
        return $this->hasOne(Outbound::class, 'id', 'outbound_id');
    }

    public function product () {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}