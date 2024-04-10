<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
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

