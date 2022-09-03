<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Account\LoginController;
use App\Http\Controllers\admin\DashboardController;

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
// URL:/login
Route::get('/login', [LoginController::class, 'ShowPageLogin'])->name('login');
Route::post('/login', [LoginController::class, 'Authenticate']);

Route::middleware(['auth'])->group(function () {
    // GET URL:/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
