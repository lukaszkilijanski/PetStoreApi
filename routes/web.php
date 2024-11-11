<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetsController;

Route::prefix('/')->group(function(){
    Route::get('',[PetsController::class,'index'])->name('pets');
    Route::get('edit/{petId}',[PetsController::class,'edit'])->name('pet.edit');
    Route::get('create', [PetsController::class, 'create'])->name('pet.create');
    Route::post('save',[PetsController::class,'save'])->name('pet.save');
    Route::delete('remove',[PetsController::class,'remove'])->name('pet.remove');
    Route::get('find',[PetsController::class,'find'])->name('pet.find');
});



