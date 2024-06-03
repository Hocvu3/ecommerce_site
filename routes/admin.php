<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\PaymentGateWaySettingController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard');

    Route::get('/profile',[ProfileController::class,'index'])->name('profile');

    Route::put('/profile',[ProfileController::class,'updateProfile'])->name('profile.update');

    Route::put('/profile/password',[ProfileController::class,'updatePassword'])->name('profile.change-password');

    // Slider
    Route::resource('slider',SliderController::class);

    //Category
    Route::resource('category',CategoryController::class);

    //Products
    Route::resource('product',ProductController::class);

    //Product Gallary
    Route::get('product-gallery/{product}',[ProductGalleryController::class,'index'])->name('product-gallery.show.index');
    Route::resource('product-gallery',ProductGalleryController::class);

    //Product Size
    Route::get('product-size/{product}',[ProductSizeController::class,'index'])->name('product-size.show.index');
    Route::resource('product-size', ProductSizeController::class);

    //Product Option
    Route::resource('product-option',ProductOptionController::class);

    //Coupon
    Route::resource('coupon', CouponController::class);

    //Delivery Area
    Route::resource('delivery-area',DeliveryAreaController::class);

    //payment gateway
    Route::get('payment-settings',[PaymentGateWaySettingController::class,'index'])->name('payment-settings.index');
    Route::put('payment-gateway/update',[PaymentGateWaySettingController::class,'updatePaymentGateWaySetting'])->name('payment-settings.update');
}
);
