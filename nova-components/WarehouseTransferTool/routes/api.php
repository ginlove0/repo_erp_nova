<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });



Route::get('/timThuXemNhe/findAllSupplierInDB', \Ipsupply\WarehouseTransferTool\Http\Controllers\SupplierController::class.'@show');

Route::get('/findSomething/modelGetAll', \Ipsupply\WarehouseTransferTool\Http\Controllers\ModelController::class.'@show');

Route::get('/addItemToStock/{product}', \Ipsupply\WarehouseTransferTool\Http\Controllers\ItemController::class.'@addItemToStock');

Route:: get('/findCategoryInManuallyAdd/Category', \Ipsupply\WarehouseTransferTool\Http\Controllers\Category::class.'@show');

Route::get('/findManufactorInManuallyAdd/Manufactor', \Ipsupply\WarehouseTransferTool\Http\Controllers\ManyfactorController::class.'@show');

Route::get('/addNewModel/{modelDetail}', \Ipsupply\WarehouseTransferTool\Http\Controllers\ModelController::class.'@addModelInManuallyAdd')
    ->where('modelDetail', '(.*)');

Route::get('/findModelByName/{modelName}', \Ipsupply\WarehouseTransferTool\Http\Controllers\ModelController::class.'@findModelByName');

Route::get('/addNewSupplier/{supplierDetail}', \Ipsupply\WarehouseTransferTool\Http\Controllers\SupplierController::class.'@addSupplierInManuallyAdd');

Route::get('/findSupplierByNameInAddManu/{supplerName}', \Ipsupply\WarehouseTransferTool\Http\Controllers\SupplierController::class.'@findSupplierByName')
    ->where('supplerName', '(.*)');


