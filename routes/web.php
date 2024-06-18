<?php
use App\Http\Controllers\UserDetailController;

Route::get('register', [UserDetailController::class, 'create']);
Route::post('register', [UserDetailController::class, 'store']);

Route::get('login', [UserDetailController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserDetailController::class, 'login']);
