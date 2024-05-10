<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontFlashSaleController;
use App\Http\Controllers\Frontend\ProductDetailsController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UseProfileController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\ProfileController;

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
//     return view('frontend.home.dashboard');
// });
// Route::get('/dashboard', function () {
//     return view('frontend.dashboard.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [FrontendController::class, 'index'])->name('user.index');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin Login 
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// 

Route::get('flash-sale', [FrontFlashSaleController::class, 'index'])->name('flash-sale');
Route::get('product-detail/{slug}', [ProductDetailsController::class, 'showProduct'])->name('product-details');

// Cart Route-----
// Add Product In Cart Using Ajax---
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('add-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('update-qty', [CartController::class, 'updateQty'])->name('update-qty');
// End Cart Route
//Use Dashboard---

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboadr');
    //User Profile
    Route::get('profile', [UseProfileController::class, 'index'])->name('profile');
    // User Profile Update
    Route::put('profile', [UseProfileController::class, 'profileUpdate'])->name('profile.update');
    //Password Update
    Route::post('profile', [UseProfileController::class, 'passwordUpdate'])->name('password.update');

    Route::resource('address', UserAddressController::class);
});
