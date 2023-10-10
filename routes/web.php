<?php

use App\Http\Controllers\CustomerController;
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

Route::get('customer/create', [CustomerController::class, 'create']);
Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
Route::post('customers', [CustomerController::class, 'store']);
Route::delete('customer/{customer}', [CustomerController::class, 'destroy']);
Route::get('customer/edit/{customer}', [CustomerController::class, 'edit']);
Route::put('customer/update/{customer}', [CustomerController::class, 'update']);