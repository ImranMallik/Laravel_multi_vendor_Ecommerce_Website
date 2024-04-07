<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProfileController;


// Admin Route 
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// Profile Route 
Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
// Profile Image && email Update Route
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
// Profile Password Update Route 
Route::post('profile/update/password', [ProfileController::class, 'updatepassword'])->name('password.update');

//Slider--
Route::resource('slider', SliderController::class);

// Category

// Change Status Route-----
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

//Sub-Category
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('subcategory.change-status');
Route::resource('sub-category', SubCategoryController::class);

//ChildCategory

Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubcategory'])->name('get-subcategory');
Route::resource('child-category', ChildCategoryController::class);

// Brand Item--

Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

// Vendor Profile
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Products route--
//1 -Sub category Ajax
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
//2 child category Ajax--
Route::get('products/get-childcategories', [ProductController::class, 'getChildCategories'])->name('product.child-categories');
// Product Change Status
Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);
// Product Image Multipal IMG
Route::resource('products-image-gallery', ProductImageGalleryController::class);
// Product Variant route
// Product Variant Change Status
Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');

Route::resource('products-variant', ProductVariantController::class);

// Product Variant Item----

Route::get('product-variant-item/{productId}/{variantId}',[ProductVariantItemController::class,'index'])->name('product-variant-item.index');
Route::get('product-variant-item/create/{productId}/{variantId}',[ProductVariantItemController::class,'create'])->name('product-variant-item.create');
Route::post('product-variant-item',[ProductVariantItemController::class,'store'])->name('product-variant-item.store');
Route::get('product-variant-item-edit/{variantItemId}',[ProductVariantItemController::class,'edit'])->name('product-variant-item.edit');
Route::put('product-variant-item-update/{variantItemId}',[ProductVariantItemController::class,'update'])->name('product-variant-item.update');
Route::delete('product-variant-item-destroy/{variantItemId}',[ProductVariantItemController::class,'destroy'])->name('product-variant-item.destroy');
Route::put('product-variant-item-status',[ProductVariantItemController::class,'changeStatus'])->name('product-variant-item.change-status');
