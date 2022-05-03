<?php

use App\Http\Controllers\Admin_controller;
use App\Http\Controllers\Client_controller;
use App\Http\Controllers\Item_controller;
use App\Http\Controllers\Temp_item_controller;
use App\Http\Controllers\User_controller;
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


Route::get('/role', [Client_controller::class,'roleDevider'])->name('role.devider');
//site root route
Route::get('/', [Client_controller::class,'index'])->name('client_index');
Route::get('logout', [User_controller::class, 'logout'])->name('logout');

Route::prefix('user')->group(function(){
    Route::get('/', [User_controller::class,'index'])->name('user.index');
    Route::post('/', [User_controller::class,'save'])->name('user.save');
});


//admin routes
Route::prefix('admin')->group(function(){
    Route::get('/', [Admin_controller::class,'index'])->name('admin_index');
    Route::get('/item', [Admin_controller::class,'item'])->name('admin_item');
    Route::get('/profile', [Admin_controller::class,'profile'])->name('admin_profile');

    Route::get('/{id}/update',[Admin_controller::class,'updateUser'])->name('admin.update');
    Route::post('/{id}/updater',[Admin_controller::class,'updaterUser'])->name('admin.updater');
    Route::get('/{id}/delete',[Admin_controller::class,'deleteUser'])->name('admin.delete');
    Route::get('/{order}/confirm',[Admin_controller::class,'orderConfirm'])->name('admin.order.confirm');
    Route::get('/{order}/delete_order',[Admin_controller::class,'orderDelete'])->name('admin.order.delete');
    Route::get('/{order}/delete_complete',[Admin_controller::class,'orderComplete'])->name('admin.order.complete');
});


//client routes
Route::prefix('client')->group(function(){
    Route::get('/', [Client_controller::class,'index'])->name('client_index');
    Route::get('/clientPage', [Client_controller::class,'clientPage'])->name('client_page');
    Route::get('/{id}/delete', [Client_controller::class,'deleteItem'])->name('tempitem.delete');
    Route::get('/{user}/newOrder', [Client_controller::class,'newOrder'])->name('client.new.order');
    Route::get('/{user}/placeOrder', [Client_controller::class,'placeOrder'])->name('client.place.order');
});

Route::prefix('item')->group(function(){
    Route::post('/save', [Item_controller::class,'saveItem'])->name('item.save');
    Route::get('/{id}/update',[Item_controller::class,'findItem'])->name('item.update');
    Route::get('/{id}/delete',[Item_controller::class,'deleteItem'])->name('item.delete');
    Route::post('/{id}/updater',[Item_controller::class,'itemUpdater'])->name('item.updater');
});

Route::prefix('temp')->group(function(){
    Route::post('/{id}/find',[Temp_item_controller::class,'findItem'])->name('temp.find');
});
