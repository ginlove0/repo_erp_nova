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
Route::get('/{sn}', \Ipsupply\SearchMultipleUsItem\Http\Controllers\SearchMultipleUsItem::class.'@findUsItem');

Route::get('/outStock/{sn}', \Ipsupply\SearchMultipleUsItem\Http\Controllers\SearchMultipleUsItem::class.'@outstock');

Route::get('/inStock/{sn}', \Ipsupply\SearchMultipleUsItem\Http\Controllers\SearchMultipleUsItem::class.'@instock');
