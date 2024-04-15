<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
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
Route::put('products/change-status', [VendorProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', VendorProductController::class);

// Vendor product image route 

Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

// Product Variant
// Change Status ---- 
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant',VendorProductVariantController::class);

// Product Variant Item----

Route::get('product-variant-item/{productId}/{variantId}',[VendorProductVariantItemController::class,'index'])->name('product-variant-item.index');
Route::get('product-variant-item/create/{productId}/{variantId}',[VendorProductVariantItemController::class,'create'])->name('product-variant-item.create');
Route::post('product-variant-item',[VendorProductVariantItemController::class,'store'])->name('product-variant-item.store');
Route::get('product-variant-item-edit/{variantItemId}',[VendorProductVariantItemController::class,'edit'])->name('product-variant-item.edit');
Route::put('product-variant-item-update/{variantItemId}',[VendorProductVariantItemController::class,'update'])->name('product-variant-item.update');
Route::delete('product-variant-item-destroy/{variantItemId}',[VendorProductVariantItemController::class,'destroy'])->name('product-variant-item.destroy');
Route::put('product-variant-item-status',[VendorProductVariantItemController::class,'changeStatus'])->name('product-variant-item.change-status');