<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [ProductController::class, 'index'])->name('all.products');
Route::post('/store-product', [ProductController::class, 'store'])->name('store.product');
Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit.product');
Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('update.product');
Route::get('/delete-product/{id}', [ProductController::class, 'destroy'])->name('delete.product');
