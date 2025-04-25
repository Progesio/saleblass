<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IpaymuController;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/ipaymu/purchase', [IpaymuController::class, 'purchase'])->name('ipaymu.purchase');
Route::get('/ipaymu/success', [IpaymuController::class, 'success'])->name('ipaymu.success');
Route::get('/ipaymu/cancel', [IpaymuController::class, 'cancel'])->name('ipaymu.cancel');
Route::post('/ipaymu/notify', [IpaymuController::class, 'notify'])->name('ipaymu.notify');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
