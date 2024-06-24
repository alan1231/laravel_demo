<?php

use App\Http\Controllers\FlavorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('flavors', FlavorController::class);