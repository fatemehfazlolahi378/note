<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['as' => 'desktop.'], function () {
    Route::get('/', [\App\Http\Controllers\Desktop\SiteController::class , 'index'])->name('index');
    Route::resource('/categories', \App\Http\Controllers\Desktop\CategoryController::class);
    Route::resource('/notes', \App\Http\Controllers\Desktop\NoteController::class);
    Route::get('/subcategory/get/{id}',[\App\Http\Controllers\Desktop\CategoryController::class,'getSubCat']);

});
