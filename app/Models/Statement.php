<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statement extends CommonModel {
    use SoftDeletes;

    protected $table = 'statement';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function createrManager() {
        return $this->hasOne(Managers::class, 'id', 'creater')->select('id', 'username');
    }

    public function sale () {
        return $this->belongsTo(Sale::class, 'sale_code', 'code');
    }

    public function detail() {
        return $this->hasMany(StatementDetail::class, 'statement_id', 'id');
    }
}