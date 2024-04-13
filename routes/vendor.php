<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;

// Vendor Route 
Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

// Vendor Profile Controller-
Route::get('/profile',[VendorProfileController::class,'profile'])->name('profile');

//Vendor Profile Update-
Route::put('profile', [VendorProfileController::class, 'profileUpdate'])->name('profile.update');
//Vendor PassWord Update-
Route::post('profile',[VendorProfileController::class,'passwordUpdate'])->name('password.update');
// Vendor ShopProfileController----
Route::resource('shop-profile', VendorShopProfileController::class);

// Products Route
//1 -Sub category Ajax
Route::get('product/get-subcategories', [VendorProductController::class, 'getSubCategories'])->name('product.get-subcategories');
//2 child category Ajax--
Route::get('products/get-childcategories', [VendorProductController::class, 'getChildCategories'])->name('product.child-categories');
Route::resource('products', VendorProductController::class);

// Vendor product image route 

Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

// Product Variant
Route::resource('products-variant',VendorProductVariantController::class);