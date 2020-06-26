<?php

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

//Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');


Route::get('/ipsupply/findSaleOrderModels/{saleOrderId}',  "SaleOrderController@findSaleOrderModels");

Route::get('/ipsupply/findBySN/{sn}', "ItemController@findBySN");

Route::get('/ipsupply/checkLegitSn/{sn}', "ItemController@findBySNwithOther");

Route::get('/ipsupply/findItemDetail/{modelId}/{conditionId}/{whLocationId}', 'ItemController@findItemDetail');
