<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. You're free to add
| as many additional routes to this file as your tool may require.
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });
Route::get('/addProductToWhTransfer/{whtransferId}/{product}', \Ipsupply\ItemTransferResourceTool\Http\Controllers\ItemTransferResourceToolController::class . '@addProduct');

Route::get('findModel', \Ipsupply\ItemTransferResourceTool\Http\Controllers\ItemTransferResourceToolController::class.'@findAllModel');

Route::get('/findModelInWhTransfer/{whTransferId}', \Ipsupply\ItemTransferResourceTool\Http\Controllers\ItemTransferResourceToolController::class.'@fetchModelWhTransfer');

Route::get('/deleteItem/{id}', \Ipsupply\ItemTransferResourceTool\Http\Controllers\ItemTransferResourceToolController::class.'@deleteItemInWhTransfer');

Route::get('/addNewModelInWhTransfer/{modelDetail}', \Ipsupply\ItemTransferResourceTool\Http\Controllers\ItemTransferResourceToolController::class.'@addModel');

Route::get('findManufactor', \Ipsupply\ItemTransferResourceTool\Http\Controllers\ItemTransferResourceToolController::class.'@findAllManufactor');

Route::get('findCategory', \Ipsupply\ItemTransferResourceTool\Http\Controllers\ItemTransferResourceToolController::class.'@findAllCategory');
