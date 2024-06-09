<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\a;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\FrontFlashSaleController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductDetailsController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UseProfileController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserOrderController;
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
// Clear All Cart--__
Route::get('clear-all-cart', [CartController::class, 'clearAllCart'])->name('clear-all-cart');
// Delete Singel Cart Item 
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('clear-singel-item');
// Count Cart Item Dynamic---__
Route::get('cart-item-count', [CartController::class, 'countCartItem'])->name('count-cart-item');
// Add mini Cart Product ------____
Route::get('mini-cart-product', [CartController::class, 'addMiniCart'])->name('add-mini-cart');
// Remove mini Cart item-----
Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
// All mini cart item price
Route::get('cart/sidebar-product-total', [CartController::class, 'sidebarProductTotal'])->name('cart.sidebar-product-total');
// End Cart Route
//Use Dashboard---

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    // Order route
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboadr');
    //User Profile
    Route::get('profile', [UseProfileController::class, 'index'])->name('profile');
    // User Profile Update
    Route::put('profile', [UseProfileController::class, 'profileUpdate'])->name('profile.update');
    //Password Update
    Route::post('profile', [UseProfileController::class, 'passwordUpdate'])->name('password.update');
    Route::resource('address', UserAddressController::class);
    // Check Out---____
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('checkout/create-checkout', [CheckOutController::class, 'createCheckout'])->name('create.checout');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkoutFormSubmit'])->name('checout.formsubmit');
    // Payment 
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    // Paypal Route
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    // stripe route
    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
});

// Coupon Route
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
// CalculateDiscount of - coupon Code
Route::get('calculate-discount-cupon', [CartController::class, 'calculateDiscount'])->name('calculate-discount-cupon');
Route::get('products', [ProductDetailsController::class, 'productIndex'])->name('product.index');
Route::get('change-product-list-view', [ProductDetailsController::class, 'changeListView'])->name('product-list-view');
