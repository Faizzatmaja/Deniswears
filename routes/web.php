<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController; 


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |---------------- ADMIN ----------------
    */
    Route::prefix('admin')
        ->middleware('role:admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Products
            Route::resource('products', ProductController::class);

            // Orders Management
            Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
            Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
            Route::post('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
            Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
        });

    /*
    |---------------- USER ----------------
    */
    Route::prefix('user')
        ->middleware('role:user')
        ->name('user.')
        ->group(function () {

            Route::get('/home', [HomeController::class, 'index'])->name('home');
            
            // Product Detail Route (Tambahkan ini)
            Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

            Route::get('/about', function () {
                return view('user.about');
            })->name('about');

            // Cart Routes
            Route::get('/cart', [CartController::class, 'index'])->name('cart');
            Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
            Route::patch('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
            Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
            Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

            // Checkout Routes
            Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
            Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

            // Orders Routes
            Route::get('/orders', [OrderController::class, 'index'])->name('orders');

            // Profile
            Route::get('/profile', function () {
                return view('user.profile');
            })->name('profile');
        });
});