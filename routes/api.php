<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/index', [ProductController::class, 'index'])->name('api.index');
Route::post('/store', [ProductController::class, 'store'])->name('api.store');
Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('api.edit');
Route::put('/update/{id}', [ProductController::class, 'update'])->name('api.update');
Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('api.destroy');
