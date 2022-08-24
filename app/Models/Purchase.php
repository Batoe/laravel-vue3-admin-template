<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends CommonModel {
    use SoftDeletes;

    protected $table = 'purchase';

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
        return $this->hasMany(PurchaseDetail::class, 'purchase_id', 'id');
    }

    public function sale() {
        return $this->belongsTo(Sale::class, 'sale_code', 'code');
    }

    public function warehousing() {
        return $this->hasMany(Warehousing::class, 'purchase_code', 'code');
    }
}