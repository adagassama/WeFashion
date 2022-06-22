<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin/product',ProductController::class)->middleware(['auth']);
Route::resource('admin/category',CategoryController::class)->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [FrontController::class, 'index']);
Route::get('product/{id}', [FrontController::class, 'show'])->where(['id' => '[0-9]+']);
Route::get('solde', [FrontController::class, 'showProductBySolde']);
Route::get('category/{id}', [FrontController::class, 'showProductByCategory'])->where(['id' => '[0-9]+']);
