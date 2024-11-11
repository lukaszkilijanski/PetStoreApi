<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetsController;

Route::prefix('/')->group(function(){
    Route::get('',[PetsController::class,'index'])->name('pets');
    Route::get('edit/{petId}',[PetsController::class,'edit'])->name('pets.edit');
    Route::post('save',[PetsController::class,'save'])->name('pet.save');
});



