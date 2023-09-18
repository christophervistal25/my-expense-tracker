<?php

use App\Http\Controllers\BillsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SheetController as TransactionSheetController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('transactions', TransactionController::class);
    Route::resource('bills', BillsController::class);
    Route::get('sheet', TransactionSheetController::class)->name('sheet.create');
    Route::post('sheet', [TransactionSheetController::class, 'store'])->name('sheet.store');

    Route::resource('categories', CategoryController::class);
});
