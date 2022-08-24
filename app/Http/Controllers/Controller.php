<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $companyType = [
        '1' => '销售',
        '2' => '采购',
        '3' => '销售 + 采购'
    ];

    public $codeType = [
        '1' => 'XS',
        '2' => 'CG',
        '3' => 'CK',
        '4' => 'RK',
        '5' => 'JS'
    ];
}
