<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;

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

Route::get('/', [BlogsController::class, 'landing']);
Route::get('/article/category/{category}', [BlogsController::class, 'category']);
Route::get('/article/{slug}', [BlogsController::class, 'article']);

Route::get('/a', [TransaksiController::class, 'index']);
Route::post('/registrasi', [TransaksiController::class, 'process']);