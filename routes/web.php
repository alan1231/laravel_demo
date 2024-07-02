<?php

use App\Http\Controllers\FlavorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('flavors', FlavorController::class);
Route::get('flavors/{id}/upload-image', [FlavorController::class, 'showUploadImageForm'])->name('flavors.showUploadImageForm');
Route::post('flavors/{id}/upload-image', [FlavorController::class, 'uploadImage'])->name('flavors.uploadImage');