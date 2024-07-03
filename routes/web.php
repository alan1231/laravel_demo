<?php

use App\Http\Controllers\FlavorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('flavors', FlavorController::class);
// 显示上传图片表单
Route::get('flavors/{id}/upload-image', [FlavorController::class, 'showUploadImageForm'])->name('flavors.showUploadImageForm');

// 显示编辑图片表单
Route::get('flavors/{id}/edit-image', [FlavorController::class, 'editImageForm'])->name('flavors.editImageForm');

// 处理图片上传
Route::post('flavors/{id}/upload-image', [FlavorController::class, 'uploadImage'])->name('flavors.uploadImage');

// 处理图片更新
Route::put('flavors/{id}/update-image', [FlavorController::class, 'updateImage'])->name('flavors.updateImage');