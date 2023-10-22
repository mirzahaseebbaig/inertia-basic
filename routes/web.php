<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('customers', [CustomerController::class, 'index'])->name('customer.list');
Route::post('customers', [CustomerController::class, 'store']);
Route::delete('customer/{customer}', [CustomerController::class, 'destroy']);
Route::get('customer/edit/{customer}', [CustomerController::class, 'edit']);
Route::put('customer/update/{customer}', [CustomerController::class, 'update']);
