<?php

use App\Http\Controllers\ProfileController;
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

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.' , 'middleware' => 'auth'], function () {
    Route::get('/',[\App\Http\Controllers\Dashboard\DashboardController::class , 'index'])->name('index');
    Route::get('/profile/edit', [\App\Http\Controllers\Dashboard\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [\App\Http\Controllers\Dashboard\ProfileController::class, 'update'])->name('profile.update');
    Route::resource('/categories',\App\Http\Controllers\Dashboard\CategoryController::class);
    Route::resource('/tags',\App\Http\Controllers\Dashboard\TagController::class);
    Route::resource('/notes',\App\Http\Controllers\Dashboard\NoteController::class);
    Route::get('/notes/{slug}',[\App\Http\Controllers\Dashboard\NoteController::class,'show'])->name('notes.show');
    Route::get('/list-category',[\App\Http\Controllers\Dashboard\CategoryController::class , 'list'])->name('categories.list');
    Route::get('/subcategory/get/{id}',[\App\Http\Controllers\Dashboard\CategoryController::class,'getSubCat']);
    Route::get('/meili', [\App\Http\Controllers\Dashboard\NoteController::class,'getData']);



});


Route::group(['as' => 'desktop.'], function () {
    Route::resource('/',\App\Http\Controllers\Desktop\SiteController::class);
    Route::post('/check-user',[\App\Http\Controllers\Desktop\LoginController::class,'checkUser'])->name('checkUser')->middleware('throttle:5,1');
    Route::post('/user-login',[\App\Http\Controllers\Desktop\LoginController::class,'login'])->name('login')->middleware('throttle:5,1');
    Route::post('/resend-code',[\App\Http\Controllers\Desktop\LoginController::class,'resend'])->name('resend')->middleware('throttle:5,1');
    Route::post('/register-user',[\App\Http\Controllers\Desktop\LoginController::class,'register'])->name('register')->middleware('throttle:5,1');
    Route::post('/login-password',[\App\Http\Controllers\Desktop\LoginController::class,'loginPassword'])->name('password')->middleware('throttle:5,1');
});

require __DIR__.'/auth.php';
