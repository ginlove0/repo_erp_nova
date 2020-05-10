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

//Route::get('/{sn}', \App\Http\Controllers\ItemController::class.'@findBySNwithOther');

Route::get('/{sn}', \Ipsupplt\SearchMultipleItems\Http\Controllers\SearchMultipleController::class.'@findBySNwithOther');


Route::get('/outStock/{sn}', \Ipsupplt\SearchMultipleItems\Http\Controllers\SearchMultipleController::class.'@outStockSn');

Route::get('/inStock/{sn}', \Ipsupplt\SearchMultipleItems\Http\Controllers\SearchMultipleController::class.'@inStockSn');
