<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatementDetail extends CommonModel {
    use SoftDeletes;

    protected $table = 'statement_detail';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'statement_id',
        'code',
        'type',
        'date',
        'auditer',
        'audite_time',
        'product_id',
        'product_name',
        'num',
        'unit',
        'price',
        'money'
    ];

    public function statement()
    {
        return $this->belongsTo(Sale::class, 'id', 'statement_id');
    }

    public function product() {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}