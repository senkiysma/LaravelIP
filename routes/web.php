<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IpController;
use Illuminate\Support\Facades\Hash;
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
    
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::middleware([App\Http\Middleware\WhiteList::class])->group(function(){
    Route::group(['middleware' => ['auth']], function () {
        Route::get("changePassword",[UserController::class,"changePassword"])->name("user.changePassword");
        Route::post("updatePassword",[UserController::class,"updatePassword"])->name("user.updatePassword");
    });
    
    Route::group(['prefix' => "admin", 'as' =>  'admin.', 'middleware' => ['auth','roleAdmin']], function () {
        Route::get("accounts",[AccountController::class,"index"])->name("account.index");
        Route::get("listByUser",[AccountController::class,"listByUser"])->name("user.accounts");
        Route::resource("user", UserController::class);
        Route::get("deleteUser",[UserController::class,"delete"])->name("user.delete");
    
        Route::get("import",[ImportController::class,"index"])->name("import.index");
        Route::post("upload",[ImportController::class,"upload"])->name("import.upload");
        Route::get("doImport",[ImportController::class,"import"])->name("import.import");
        Route::get("doDelete",[ImportController::class,"delete"])->name("import.delete");
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::group(['prefix'=> 'settings', 'as'=>'settings.'], function(){
            Route::resource('ip', IpController::class);
        });
    });
    
    Route::group(['prefix' => "member", 'as' =>  'member.', 'middleware' => ['auth']], function () {
        Route::get("accounts",[App\Http\Controllers\Member\AccountController::class,"index"])->name("account.index");
        Route::get('/', [App\Http\Controllers\Member\AccountController::class, 'index'])->name('account.index');
        Route::get('/checkout', [App\Http\Controllers\Member\AccountController::class, 'checkout'])->name('account.checkout');
        Route::get("user",[App\Http\Controllers\Member\UserController::class,"index"])->name("user.index");
    });    
});
