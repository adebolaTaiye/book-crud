<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;




Route::get('/create',[BookController::class,'create'])->name('book.create');
Route::post('/store',[BookController::class,'store'])->name('book.store');
Route::get('/book/{book}/show',[BookController::class,'show'])->name('book.show');
Route::get('/book/{book}',[BookController::class,'edit'])->name('book.edit');
Route::patch('/book/{book}',[BookController::class,'update'])->name('book.update');
Route::delete('/book/{book}',[BookController::class,'destroy'])->name('book.destroy');
Route::get('/',[BookController::class,'index'])->name('book.index');

