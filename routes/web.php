<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Guest\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trang-chu', [HomeController::class, 'index'])->name('trangchu');
Route::post('/LoadMore', [HomeController::class, 'LoadMore']);
Route::get('/danh-muc/{slug?}.html', [HomeController::class, 'LoadProductByMenu']);
Route::get('/san-pham/{slug?}.html', [HomeController::class, 'ShowProduct']);

Route::get('/gio-hang', [HomeController::class, 'ListCartSession'])->name('CartSession.List');
Route::post('/gio-hang', [HomeController::class, 'StoreCartSession']);
Route::get('/gio-hang/remove/{id?}', [HomeController::class, 'RemoveItemCartSession']);
Route::post('/gio-hang/UpdateCartSession', [HomeController::class, 'UpdateItemCartSession'])->name('Update.Cart.Session');

//==============================================================================

// GET URL:/login
Route::get('/login', [LoginController::class, 'ShowPageLogin'])->name('login');
// POST URL:/login
Route::post('/login', [LoginController::class, 'Authenticate']);

Route::middleware(['auth'])->group(function () {

    // GET URL:/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/menu')->group(function () {
        // GET URL:/menu/list
        Route::get('/list', [MenuController::class, 'List'])->name('Menu.List');
        // GET URL:/menu/create
        Route::get('/create', [MenuController::class, 'Create'])->name('AdminMenuCreate');
        // POST URL:/menu/store
        Route::post('/store', [MenuController::class, 'Store'])->name('Menu.Store');
        // DELETE URL:/menu/remove
        Route::delete('/remove', [MenuController::class, 'Destroy'])->name('Menu.Destroy');
        // GET URL:/menu/edit/{menu}
        Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('Menu.Edit');
        // PUT URL:/menu/update
        Route::put('/update', [MenuController::class, 'update'])->name('Menu.Update');
    });

    Route::prefix('/admin')->group(function () {
        Route::resource('products', ProductController::class)->except(['show'])
            ->missing(function (Request $req) {
                return Redirect::route('products.index');
            });

        Route::resource('slide', SlideController::class)->except(['show'])
            ->missing(function () {
                return Redirect::route('slide.index');
            });

        Route::resource('cart', CartController::class)->except(['show'])
            ->missing(function () {
                return Redirect::route('cart.index');
            });

        Route::resource('customer', CustomerController::class)->except(['show'])
            ->missing(function () {
                return Redirect::route('customer.index');
            });
    });
});
