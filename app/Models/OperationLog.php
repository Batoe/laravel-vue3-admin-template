<?php

namespace App\Models;

use App\Models\Traits\CommonModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperationLog extends CommonModel
{
    use SoftDeletes;
    // protected $table = 'operation_log';

    // protected $dateFormat = 'U';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}