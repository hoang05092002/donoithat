<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
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

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/single-product/{id}', [ProductsController::class, 'show'])->name('sl-product');

Route::prefix('/cart')->name('cart')->group(function () {
    Route::post('/store/{product}', [CartController::class, 'store'])->name('.store');
    Route::get('/', [CartController::class, 'index'])->name('.list');
});

Route::middleware('auth')->prefix('/checkout')->name('checkout')->group(function () {
    Route::post('/', [TransactionController::class, 'checkout'])->name('.index');
    Route::post('/order/{total}', [TransactionController::class, 'store'])->name('.order');
});

Route::get('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');

// Route::get('/test', [CartController::class, 'addToCart']);

Route::get('/contact', function () {
    return view('client.contact', [
        'nav_hover' => 'contact',
    ]);
})->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login-google', [GoogleLoginController::class, 'getLogin'])->name('google');
    Route::get('/google/callback', [GoogleLoginController::class, 'callback'])->name('loginGoogle');

    Route::prefix('sign-in')->name('sign-in')->group(function () {
        Route::get('/', [AuthController::class, 'loginForm']);
        Route::post('/check', [AuthController::class, 'getLogin'])->name('.check');
    });

    Route::prefix('/register')->name('register')->group(function () {
        Route::get('/', [AuthController::class, 'registerForm']);
        Route::post('/store', [AuthController::class, 'getRegister'])->name('.store');
    });
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/change-password', [GoogleLoginController::class, 'changePassword'])->name('changePassword');
Route::middleware('auth')->prefix('/users')->name('users')->group(function () {
    Route::get('/', [AuthController::class, 'show']);
    Route::put('update/{user}', [AuthController::class, 'update'])->name('.update');
    Route::get('/track-order', [TransactionController::class, 'show'])->name('.trackOrder');
});

Route::middleware('auth.admin')->prefix('/admin')->name('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('.dashboard');

    Route::prefix('/users')->name('.users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('.list');
        Route::delete('/delete/{id}', [UsersController::class, 'delete'])->name('.delete');
        Route::post('/change-status/{user}', [UsersController::class, 'changeStatus'])->name('.change-status');
        Route::post('/change-permission/{user}', [UsersController::class, 'changePermission'])->name('.change-permission');
        Route::get('/search', [UsersController::class, 'search'])->name('.search');
    });

    Route::prefix('/products')->name('.products')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('.list');
        Route::get('/create', [ProductsController::class, 'create'])->name('.create');
        Route::post('/store', [ProductsController::class, 'store'])->name('.store');
        Route::post('/edit/{product}', [ProductsController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [ProductsController::class, 'update'])->name('.update');
        Route::delete('/delete/{product}', [ProductsController::class, 'delete'])->name('.delete');
        Route::post('/change/{product}', [ProductsController::class, 'changeStatus'])->name('.change');
        Route::get('/search', [ProductsController::class, 'search'])->name('.search');
    });

    Route::prefix('catalogs')->name('.catalogs')->group(function () {
        Route::get('/', [CatalogController::class, 'index'])->name('.list');
        Route::get('/create', [CatalogController::class, 'create'])->name('.create');
        Route::post('/store', [CatalogController::class, 'store'])->name('.store');
        Route::post('/edit/{catalog}', [CatalogController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [CatalogController::class, 'update'])->name('.update');
        Route::delete('/delete/{catalog}', [CatalogController::class, 'delete'])->name('.delete');
    });

    Route::prefix('orders')->name('.orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('.list');
        Route::get('/create', [OrderController::class, 'create'])->name('.create');
        Route::post('/store', [OrderController::class, 'store'])->name('.store');
        Route::post('/edit/{product}', [OrderController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('.update');
        Route::delete('/delete', [OrderController::class, 'delete'])->name('.delete');
    });

    Route::prefix('/transactions')->name('.transactions')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('.list');
        Route::get('/create', [TransactionController::class, 'create'])->name('.create');
        Route::post('/store', [TransactionController::class, 'store'])->name('.store');
        Route::post('/changeStatus/{id}/{status}', [TransactionController::class, 'changeStatus'])->name('.changeStatus');
        Route::delete('/delete/{transaction}', [TransactionController::class, 'delete'])->name('.delete');
        Route::post('/info/{transaction}', [TransactionController::class, 'info'])->name('.info');
    });
});
