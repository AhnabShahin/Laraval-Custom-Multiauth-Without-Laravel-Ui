<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('admin/save',[AdminController::class, 'save'])->name('admin.save');
Route::post('admin/check',[AdminController::class, 'check'])->name('admin.check');
Route::get('admin/send',[AdminController::class, 'send'])->name('admin.send'); 

Route::get('admin/account/verification/{slug}',[AdminController::class, 'account_verification'])->name('admin.account_verification');
Route::get('admin/password/reset/request',[AdminController::class, 'reset_request_get'])->name('admin.reset_request_get');
Route::post('admin/password/reset/request',[AdminController::class, 'reset_request_post'])->name('admin.reset_request_post');

Route::post('admin/password/reset/form/{slug}',[AdminController::class, 'reset'])->name('admin.reset');
Route::get('admin/password/reset/form/{slug}',[AdminController::class, 'reset_form'])->name('admin.reset_form'); 
Route::group(['middleware'=>['AdminAuthCheck']],function(){
    Route::get('admin/login',[AdminController::class, 'login'])->name('admin.login');
    Route::get('admin/registration',[AdminController::class, 'registration'])->name('admin.registration');
    Route::get('admin/logout',[AdminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');

});





Route::post('user/save',[UserController::class, 'save'])->name('user.save');
Route::post('user/check',[UserController::class, 'check'])->name('user.check');
Route::get('user/send',[UserController::class, 'send'])->name('user.send'); 

Route::get('user/account/verification/{slug}',[UserController::class, 'account_verification'])->name('user.account_verification');
Route::get('user/password/reset/request',[UserController::class, 'reset_request_get'])->name('user.reset_request_get');
Route::post('user/password/reset/request',[UserController::class, 'reset_request_post'])->name('user.reset_request_post');

Route::post('user/password/reset/form/{slug}',[UserController::class, 'reset'])->name('user.reset');
Route::get('user/password/reset/form/{slug}',[UserController::class, 'reset_form'])->name('user.reset_form'); 
Route::group(['middleware'=>['UserAuthCheck']],function(){
    Route::get('user/login',[UserController::class, 'login'])->name('user.login');
    Route::get('user/registration',[UserController::class, 'registration'])->name('user.registration');
    Route::get('user/logout',[UserController::class, 'logout'])->name('user.logout');
    Route::get('user/dashboard',[UserController::class, 'dashboard'])->name('user.dashboard');

});