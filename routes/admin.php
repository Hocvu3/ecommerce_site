<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentGateWaySettingController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductRatingController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Blog;
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
    Route::put('payment-gateway/momo/update',[PaymentGateWaySettingController::class,'updateMoMoPaymentGateWaySetting'])->name('momo-payment-settings.update');
    Route::put('payment-gateway/vnpay/update',[PaymentGateWaySettingController::class,'updateVnPayPaymentGateWaySetting'])->name('vnpay-payment-settings.update');

    //Order
    Route::get('order',[OrderController::class,'index'])->name('order.index');
    Route::get('order/{id}/edit',[OrderController::class,'orderEdit'])->name('order.edit');
    Route::delete('order/{id}/delete',[OrderController::class,'orderDestroy'])->name('order.destroy');
    Route::get('order/{id}/update',[OrderController::class,'orderUpdate'])->name('order.update');

    //Product Ratings
    Route::get('product-rating',[ProductRatingController::class,'productRating'])->name('product.rating');
    Route::delete('product-rating/{id}/delete',[ProductRatingController::class,'productDestroy'])->name('product-rating.destroy');
    Route::post('product-rating/update',[ProductRatingController::class,'productUpdate'])->name('product-rating.update');
    //User
    Route::resource('user',UserController::class);
    //About
    Route::get('about',[AboutController::class,'index'])->name('about.index');
    Route::put('about/update',[AboutController::class,'update'])->name('about.update');

    //Contact
    Route::get('contact',[ContactController::class,'contactIndex'])->name('contact.index');
    Route::put('contact/update',[ContactController::class,'contactUpdate'])->name('contact.update');
    //Blog category
    Route::resource('blog-category',BlogCategoryController::class);
    //Blog
    Route::resource('blog',BlogController::class);
    Route::get('blog-comment',[BlogController::class,'blogComment'])->name('blog-comment.index');
    Route::delete('blog-comment/{id}/delete',[BlogController::class,'blogCommentDestroy'])->name('blog-comment.destroy');
    //Settings
    Route::get('email-settings',[SettingsController::class,'emailSettings'])->name('email-settings.index');
    Route::put('email-settings/update',[SettingsController::class,'emailSettingsUpdate'])->name('email-settings.update');
}
);
