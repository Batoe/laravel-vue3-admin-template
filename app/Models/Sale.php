<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends CommonModel {
    use SoftDeletes;

    protected $table = 'sale';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function company() {
        return $this->hasOne(Company::class, 'id', 'company');
    }

    public function createrManager() {
        return $this->hasOne(Managers::class, 'id', 'creater');
    }

    public function updaterManager() {
        return $this->hasOne(Managers::class, 'id', 'updater');
    }

    public function detail() {
        return $this->hasMany(SaleDetail::class, 'sale_id', 'id');
    }

    public function purchase () {
        return $this->hasMany(Purchase::class, 'sale_code', 'code');
    }

    public function outbound() {
        return $this->hasMany(Outbound::class, 'sale_code', 'code');
    }

    public function statement() {
        return $this->hasMany(Statement::class, 'sale_code', 'code');
    }
}