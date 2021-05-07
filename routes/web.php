<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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


//Auth routes starts
Route::group(['middleware' => ['auth']], function () {


Route::get('/', function () {
    return view('admin.index');
});

// Route::prefix('permission')->group(function () {

//     Route::get('/index',[RoleController::class,'index'])->name('permission.index');
//     Route::get('/create',[RoleController::class,'create'])->name('permission.create');
//     Route::post('/store',[RoleController::class,'store'])->name('permission.store');

// });

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('users')->group(function () {

    Route::get('/index',[UserController::class,'index'])->middleware(['can:users.index'])->name('users.index');
    Route::get('/create',[UserController::class,'create'])->middleware(['can:users.create'])->name('users.create');
    Route::post('/store',[UserController::class,'store'])->middleware(['can:users.store'])->name('users.store');
    Route::post('users/block',[UserController::class,'block'])->middleware(['can:users.block'])->name('users.block');
    Route::get('/edit/{id}',[UserController::class,'edit'])->middleware(['can:users.edit'])->name('users.edit');
    Route::post('/update/{id}',[UserController::class,'update'])->middleware(['can:users.update'])->name('users.update');
    Route::post('/search}',[UserController::class,'search'])->middleware(['can:users.serch'])->name('users.serch');

});
Route::prefix('roles')->group(function () {

    Route::get('/index',[RoleController::class,'index'])->middleware(['can:roles.index'])->name('roles.index');
    Route::get('/create',[RoleController::class,'create'])->middleware(['can:roles.create'])->name('roles.create');
    Route::post('/store',[RoleController::class,'store'])->middleware(['can:roles.store'])->name('roles.store');
    Route::get('/edit/{id}',[RoleController::class,'edit'])->middleware(['can:roles.edit'])->name('roles.edit');
    Route::post('/update/{id}',[RoleController::class,'update'])->middleware(['can:roles.update'])->name('roles.update');
    Route::post('roles/delete',[RoleController::class,'delete'])->middleware(['can:roles.delete'])->name('roles.delete');

});

});//Auth routes ends

