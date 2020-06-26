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

Route::get('/findDetail', \Ipsupply\ModelQuickView\Http\Controllers\ModelQuickViewController::class.'@getDetail');

Route::get('/findDetailInADay', \Ipsupply\ModelQuickView\Http\Controllers\ModelQuickViewController::class.'@getDetailInADay');

Route::get('/findDetailIn2Day', \Ipsupply\ModelQuickView\Http\Controllers\ModelQuickViewController::class.'@getDetailIn2Day');

Route::get('/findOutStockItem', \Ipsupply\ModelQuickView\Http\Controllers\ModelQuickViewController::class.'@getOutStockInADay');
