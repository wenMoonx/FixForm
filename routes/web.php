<?php

use App\Http\Controllers\Admin\DashboardPostController;
use App\Http\Controllers\Admin\PermissionsResourceController;
use App\Http\Controllers\Admin\RoleResourceController;
use App\Http\Controllers\Admin\UserResourceController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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

/**
 * * Home
 */
Route::get('/', function () {
    return Inertia::render('Auth/Login');
})->name('home');

/**
 * * Dashboard Routes
 */
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * * Profile Routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * * Auth Routes
 */
require __DIR__.'/auth.php';

/**
 * * Dashboard Posts Routes
 */
Route::middleware(['auth', 'verified', 'role_or_permission:super-admin|admin|user|manage posts'])->group(function () {
    Route::get('/dashboard/posts/getSlug', [DashboardPostController::class, 'getSlug']);
    // Route::get('/dashboard/posts/create', [DashboardPostController::class, 'create'])->name('posts.create');
    Route::resource('dashboard/posts', DashboardPostController::class, ['as' => 'dashboard']);
});

/**
 * * Dashboard Products Routes
 */
Route::middleware(['auth', 'verified', 'role_or_permission:super-admin|admin|user|manage posts'])->group(function () {
    Route::get('/dashboard/product', [ProductionController::class, 'index'])->name('product.index');
    Route::resource('dashboard/products', ProductionController::class, ['as' => 'dashboard']);
    Route::get('dashboard/product/{post:slug}', [ProductionController::class, 'show'])->name('product.show');
});

/**
 * * Dashboard Cart Routes
 */
Route::middleware(['auth', 'verified', 'role_or_permission:super-admin|admin|user|manage posts'])->group(function () {
    Route::get('/cart', function () {return Inertia::render('Dashboard/Cart/Index');})->name('cart.index');
    Route::post('/cart', [OrderController::class, 'store'])->name('cart.store');
    Route::resource('dashboard/orders', OrderController::class, ['as' => 'dashboard']);
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
});
/**
 * * Dashboard Roles, Permissions and Users Routes
 * * Only Super Admin and Admin can access this routes
 */
Route::group(['middleware' => ['auth', 'verified', 'role:super-admin|admin']], function () {
    /**
     * * Dashboard Roles Routes
     */
    Route::resource('dashboard/roles', RoleResourceController::class)->except(['show']);

    /**
     * * Dashboard Permissions Routes
     */
    Route::resource('dashboard/permissions', PermissionsResourceController::class)->except(['create', 'show', 'edit']);

    /**
     * * Dashboard Users Routes
     */
    Route::resource('dashboard/users', UserResourceController::class)->except('show');
});
