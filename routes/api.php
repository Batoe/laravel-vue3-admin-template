<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SystemController;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/userInfo', [AuthController::class, 'getAuthUser'])->middleware('apiauth');

Route::get('/test', function () {
    dd(date('Y-m-d H:i:s'));
    // return response(['message' => bcrypt('123456')]);
    // dd(get_permission());
    // $list = Products::crossJoin('warehouses')->select('products.id as product_id', 'warehouses.id as warehouse_id')->get();
    // dd($list[0]->getTable());
    // return response(['data' => $list]);
});

Route::group(['prefix' => 'common', 'middleware' => 'apiauth'], function () {
    Route::post('/upload', [CommonController::class, 'upload']);
    Route::get('/delivery', [CommonController::class, 'getDelivery']);
    Route::get('/customer', [CommonController::class, 'getCustomer']);
    Route::get('/warehouse', [CommonController::class, 'getWarehouse']);
    Route::get('/product', [CommonController::class, 'getProduct']);
    Route::get('/code', [CommonController::class, 'getCode']);
    Route::post('/bill', [CommonController::class, 'getRelationalBill']);
});

Route::group(['prefix' => 'sale', 'middleware' => 'apiauth'], function () {
    Route::get('/list', [SaleController::class, 'getSaleList']);
    Route::post("/save", [SaleController::class, 'saveSale']);
    Route::get("/{code}", [SaleController::class, 'getSale']);
    Route::delete("/{code}", [SaleController::class, 'deleteSale']);
    Route::post('/batch/delete', [SaleController::class, 'batchDeleteSale']);
    Route::post('/audit/{code}', [SaleController::class, 'auditSale']);
    Route::post('/cancelAudit/{code}', [SaleController::class, 'cancelAuditSale']);
    Route::post('/batchAudit', [SaleController::class, 'batchAuditSale']);
    Route::post('/statement/{code}', [SaleController::class, 'saveStatement']);
    Route::get('/statement/list', [SaleController::class, 'getStatementList']);
});

Route::group(['prefix' => 'purchase', 'middleware' => 'apiauth'], function () {
    Route::get('/list', [PurchaseController::class, 'getPurchaseList']);
    Route::post("/save", [PurchaseController::class, 'savePurchase']);
    Route::get("/{code}", [PurchaseController::class, 'getPurchase']);
    Route::delete("/{code}", [PurchaseController::class, 'deletePurchase']);
    Route::post('/batch/delete', [PurchaseController::class, 'batchDeletePurchase']);
    Route::post('/audit/{code}', [PurchaseController::class, 'auditPurchase']);
    Route::post('/cancelAudit/{code}', [PurchaseController::class, 'cancelAuditPurchase']);
    Route::post('/batchAudit', [PurchaseController::class, 'batchAuditPurchase']);
});

Route::group(['prefix' => 'inventory'], function () {
    // 入库
    Route::get('/warehosing/list', [InventoryController::class, 'getWarehousingList']);
    Route::get('/warehosing/{code}', [InventoryController::class, 'getWarehousing']);
    Route::post('/warehosing', [InventoryController::class, 'saveWarehousing']);
    Route::delete('/warehosing/delete/{code}', [InventoryController::class, 'deleteWarehousing']);
    Route::put('/warehosing/audit/{code}', [InventoryController::class, 'auditWarehousing']);
    Route::post('/warehosing/cancelAudit/{code}', [InventoryController::class, 'cancelAuditWarehousing']);
    Route::delete('/warehosing/batchDelete', [InventoryController::class, 'batchDeleteWarehousing']);
    Route::post('/warehosing/batchAudit', [InventoryController::class, 'batchAuditWarehousing']);
    // 出库
    Route::get('/outbound/list', [InventoryController::class, 'getOutboundList']);
    Route::get('/outbound/{code}', [InventoryController::class, 'getOutbound']);
    Route::post('/outbound', [InventoryController::class, 'saveOutbound']);
    Route::delete('/outbound/delete/{code}', [InventoryController::class, 'deleteOutbound']);
    Route::put('/outbound/audit/{code}', [InventoryController::class, 'auditOutbound']);
    Route::post('/outbound/cancelAudit/{code}', [InventoryController::class, 'cancelAuditOutbound']);
    Route::delete('/outbound/batchDelete', [InventoryController::class, 'batchDeleteOutbound']);
    Route::post('/outbound/batchAudit', [InventoryController::class, 'batchAuditOutbound']);
    // 库存
    Route::get('/finishing', [InventoryController::class, 'finishing']);
    Route::post('/list', [InventoryController::class, 'getInventory']);
});

Route::group(['prefix' => 'system'], function () {
    Route::get('/permission/all', [SystemController::class, 'getAllPermissions']);

    Route::get('/role', [SystemController::class, 'getRole']);
    Route::post('/role', [SystemController::class, 'saveRole']);
    Route::delete('/role/{id}', [SystemController::class, 'deleteRole']);

    Route::get('/manager', [SystemController::class, 'getManagers']);
    Route::post('/manager', [SystemController::class, 'saveManager']);
    Route::delete('/manager/{id}', [SystemController::class, 'deleteManager']);
    Route::post('/manager/{id}', [SystemController::class, 'pullBlack']);

    Route::get('/product', [SystemController::class, 'getProducts']);
    Route::post('/product', [SystemController::class, 'saveProduct']);
    Route::delete('/product/{id}', [SystemController::class, 'deleteProduct']);

    Route::get('/warehouse', [SystemController::class, 'getWareHouses']);
    Route::post('/warehouse', [SystemController::class, 'saveWareHouse']);
    Route::delete('/warehouse/{id}', [SystemController::class, 'deleteWareHouse']);

    Route::get('/company', [SystemController::class, 'getCompany']);
    Route::post('/company', [SystemController::class, 'saveCompany']);
    Route::delete('/company/{id}', [SystemController::class, 'deleteCompany']);
});

Route::group(['prefix' => 'log'], function () {
    Route::post('/list', [LogController::class, 'getLog']);
});
