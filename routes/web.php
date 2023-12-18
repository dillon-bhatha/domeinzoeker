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


Route::get('/', [App\Http\Controllers\SearchDomainController::class, 'view'])->name('domains');
Route::get('/winkel-wagen', [App\Http\Controllers\CartController::class, 'view'])->name('cart');
Route::get('/bestellingen', [App\Http\Controllers\OrderController::class, 'view'])->name('orders');
