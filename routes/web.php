<?php

use GuzzleHttp\Middleware;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [BookController::class, 'home'])->name('books.home');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Users
    Route::group(['prefix' => 'users', 'middleware' => ['role:admin'], 'controller' => UserController::class], function () {
        Route::get('/', 'index')->name('users.index')->middleware('can:users.index');
        Route::get('/create', 'create')->name('users.create')->middleware('can:users.create');
        Route::post('/', 'store')->name('users.store')->middleware('can:users.store');
        Route::get('/{user}/edit', 'edit')->name('users.edit')->middleware('can:users.edit');
        Route::put('/{user}', 'update')->name('users.update')->middleware('can:users.update');
        Route::delete('/{user}', 'destroy')->name('users.destroy')->middleware('can:users.destroy');
    });

    //Books
    Route::group(['prefix' => 'books', 'controller' => BookController::class], function () {
        Route::get('/', 'index')->name('books.index')->middleware('can:books.index');
        Route::get('/show/{book}', 'show')->name('books.show')->middleware('can:books.show');
        //Route::post('/', 'store')->name('books.store')->middleware('can:books.store');
        Route::post('/store', 'store')->name('books.store')->middleware('can:books.store');
        //Route::put('/{book}', 'update')->name('books.update')->middleware('can:books.update');
        Route::post('/update/{book}', 'update')->name('books.update')->middleware('can:books.update');
        Route::delete('/{book}', 'destroy')->name('books.destroy')->middleware('can:books.destroy');
    });

    //Categories
    Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
        Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
        Route::get('/get-all-dt', 'getAll')->name('categories.get-all-dt');
        Route::get('/get-all', 'index')->name('categories.get-all')->middleware('can:categories.get-all');
        //Route::get('/create', 'create')->name('categories.create')->middleware('can:categories.create');
        Route::post('/store', 'store')->name('categories.store')->middleware('can:categories.store');
        //Route::get('/{user}/edit', 'edit')->name('categories.edit')->middleware('can:categories.edit');
        Route::get('/{category}', 'show')->name('categories.show');
        Route::post('/update/{category}', 'update')->name('categories.update')->middleware('can:categories.update');
        Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
    });
});
