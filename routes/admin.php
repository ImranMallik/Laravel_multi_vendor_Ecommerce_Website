<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Models\SubCategory;

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
// -Sub category Ajax
Route::get('product/get-subcategories',[ProductController::class,'getSubCategories'])->name('product.get-subcategories');
// child category Ajax--
Route::get('products/get-childcategories',[ProductController::class,'getChildCategories'])->name('product.child-categories');
Route::resource('products', ProductController::class);
