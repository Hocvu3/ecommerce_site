<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
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

//Admin Auth Login
Route::get('/admin/login',[AdminAuthController::class,'index'])->name('admin.login');
//User Login
Route::get('/dashboard',[function(){
    return view('dashboard');
}])->name('dashboard');
//
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
