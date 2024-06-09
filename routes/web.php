<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ChefController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\WishListController;
use Illuminate\Routing\RouteRegistrar;
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
//     return view('index');
// });
Route::group(['middleware'=>'guest'],function () {
    //Admin Auth Login
    Route::get('/admin/login',[AdminAuthController::class,'index'])->name('admin.login');
    Route::get('/admin/forgot-password',[AdminAuthController::class,'resetPassword'])->name('admin.password.request');
});
Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::put('/profile/update',[ProfileController::class,'updateProfile'])->name('profile.update');
    Route::put('/profile/password/update',[ProfileController::class,'updatePassword'])->name('profile.password.update');
    Route::post('/profile/avatar/update',[ProfileController::class,'updateAvatar'])->name('profile.avatar.update');
    Route::post('/address/create',[DashboardController::class,'createAddress'])->name('address.store');
    Route::put('/address/{id}/update',[DashboardController::class,'updateAddress'])->name('address.update');
    Route::delete('/address/{id}/delete',[DashboardController::class,'destroyAddress'])->name('address.destroy');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
    Route::get('/checkout/delivery-cal/{id}',[CheckoutController::class,'checkoutCal'])->name('checkout.calculation');
    Route::post('/checkout',[CheckoutController::class,'checkoutRedirect'])->name('checkout.redirect');
    Route::get('/payment/index',[PaymentController::class,'index'])->name('payment.index');
    Route::post('/payment/make',[PaymentController::class,'makePayment'])->name('payment.make');
    //payment response
    Route::get('/payment-success',[PaymentController::class,'paymentSuccess'])->name('payment.success');
    Route::get('/payment-cancel',[PaymentController::class,'paymentCancel'])->name('payment.cancel');
    //paypal payment routes
    Route::get('/payment/paypal',[PaymentController::class,'payWithPayPal'])->name('payment.paypal');
    Route::get('/payment/paypal/success',[PaymentController::class,'successPayPal'])->name('payment.paypal.success');
    Route::get('/payment/paypal/cancel',[PaymentController::class,'cancelPayPal'])->name('payment.paypal.cancel');
    //momo payment
    Route::get('/payment/momo',[PaymentController::class,'payWithMomo'])->name('payment.momo');
    Route::get('/payment/momo/success',[PaymentController::class,'successMomo'])->name('payment.momo.success');
    Route::get('/payment/momo/cancel',[PaymentController::class,'cancelMomo'])->name('payment.momo.cancel');
    //vnpay
    Route::get('/payment/vnpay',[PaymentController::class,'payWithVnpay'])->name('payment.vnpay');
    // Route::get('/payment/momo/success',[PaymentController::class,'successMomo'])->name('payment.momo.success');
    // Route::get('/payment/momo/cancel',[PaymentController::class,'cancelMomo'])->name('payment.momo.cancel');
});
//
require __DIR__.'/auth.php';


//Homepage
Route::get('/',[FrontendController::class,'index'])->name('home');
//Get product name
Route::get('/product/{slug}',[FrontendController::class,'showProduct'])->name('product.show');
//Get menu
Route::get('/product',[FrontendController::class,'showMenu'])->name('product.menu.show');
//Get review
Route::post('/product',[FrontendController::class,'reviewStore'])->name('product.review.store');
//Get product modal route
Route::get('/load-product-modal/{productId}',[FrontendController::class,'loadProductModal'])->name('load-product-modal');
//get wishlist
Route::get('/load-wish-list/{productId}',[WishListController::class,'loadWishList'])->name('load-wish-list');


//Add to cart route
Route::get('/add-to-cart',[CartController::class,'addToCart'])->name('add-to-cart');
//Get cart product
Route::get('/get-product-cart',[CartController::class,'getCartProduct'])->name('get-cart');
//Remove cart product
Route::get('/remove-product-cart/{rowId}',[CartController::class,'removeCartProduct'])->name('remove-cart-product');
//Cart View
Route::get('/cart-view',[CartController::class,'cartIndex'])->name('cart-view');
//Cart Qty Update
Route::post('/cart-quantity-update',[CartController::class,'cartUpdate'])->name('cart.quantity-update');
//Cart Destroy
Route::get('/cart-destroy',[CartController::class,'cartDestroy'])->name('cart.quantity-destroy');
//Coupon
Route::post('/apply-coupon',[CartController::class,'applyCoupon'])->name('coupon.apply');
//Destroy
Route::post('/destroy-coupon',[CartController::class,'destroyCoupon'])->name('coupon.destroy');

//Chefs
Route::get('/chefs-index',[ChefController::class,'index'])->name('chefs.index');

//About
Route::get('/about-index',[AboutController::class,'index'])->name('about.index');

//Blogs
Route::get('/blog-index',[BlogController::class,'index'])->name('blog.index');
Route::get('/blog-details/{slug}',[BlogController::class,'show'])->name('blog.details');
Route::post('/blog-details/send-message',[BlogController::class,'sendMessage'])->name('blog.send.message');

//Contacts
Route::get('/contact-index',[ContactController::class,'index'])->name('contact.index');
Route::post('/contact-index/send',[ContactController::class,'sendMessage'])->name('contact.send.message');








