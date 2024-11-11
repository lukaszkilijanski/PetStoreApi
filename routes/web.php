<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetsController;

Route::prefix('/')->group(function(){
    Route::get('',[PetsController::class,'index'])->name('pets');
});



