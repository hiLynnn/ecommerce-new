<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\NguoiDungController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('home');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/tai-khoan', [ProfileController::class, 'show'])->name('profile');
    Route::put('/tai-khoan', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/don-hang', [OrderController::class, 'index'])->name('orders');
    Route::get('/don-hang/tao', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/don-hang', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/don-hang/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/don-hang/{id}/huy', [OrderController::class, 'cancel'])->name('orders.cancel');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('danh-muc', DanhMucController::class);
    Route::resource('san-pham', SanPhamController::class);
    Route::resource('nguoi-dung', NguoiDungController::class);
    
    // Quản lý đơn hàng
    Route::get('/don-hang', [DonHangController::class, 'index'])->name('don-hang.index');
    Route::get('/don-hang/{donHang}', [DonHangController::class, 'show'])->name('don-hang.show');
    Route::put('/don-hang/{donHang}/trang-thai', [DonHangController::class, 'updateTrangThai'])->name('don-hang.update-trang-thai');
});

// User routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/danh-muc/{slug}', [CategoryController::class, 'show'])->name('category');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/tim-kiem', [SearchController::class, 'index'])->name('search');

// Cart routes
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
Route::post('/gio-hang/them', [CartController::class, 'add'])->name('cart.add');
Route::delete('/gio-hang/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/gio-hang/{id}', [CartController::class, 'update'])->name('cart.update');
