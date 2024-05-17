<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProfileController;
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

//Homepage
Route::get('/',[FrontendController::class,'index'])->name('home');

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
});
//
require __DIR__.'/auth.php';
