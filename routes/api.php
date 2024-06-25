<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

// 定義 listFlavors 路由，對應到 listFlavors 方法
Route::get('/flavors', [ApiController::class, 'listFlavors']);

// 定義 createFlavor 路由，對應到 createFlavor 方法
Route::post('/flavors', [ApiController::class, 'createFlavor']);

Route::post('/flavors/delete', [ApiController::class, 'deleteFlavor']);