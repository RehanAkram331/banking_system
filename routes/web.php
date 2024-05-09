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

// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/login', [App\Http\Controllers\Backend\AuthController::class, 'showLogin'])->name('show-login');
Route::post('login', [App\Http\Controllers\Backend\AuthController::class, 'login'])->name('login');
Route::get('/user', [App\Http\Controllers\Backend\AuthController::class, 'registerCreate'])->name('user');
Route::post('user/store', [App\Http\Controllers\Backend\AuthController::class, 'register'])->name('user-store');
Route::group(['middleware' => 'auth'], function () {
    //error log
    Route::get('/', [App\Http\Controllers\Backend\TransactionController::class, 'index'])->name('index');
    Route::post('logout', [App\Http\Controllers\Backend\AuthController::class, 'logout'])->name('logout');
    Route::get('/deposit', [App\Http\Controllers\Backend\TransactionController::class, 'deposit'])->name('deposit');
    Route::post('/deposit/store', [App\Http\Controllers\Backend\TransactionController::class, 'depositStore'])->name('deposit-store');
    Route::get('/withdrawal', [App\Http\Controllers\Backend\TransactionController::class, 'withdrawal'])->name('withdrawal');
    Route::post('/withdrawal/store', [App\Http\Controllers\Backend\TransactionController::class, 'withdrawalStore'])->name('withdrawal-store');
});
