<?php

use App\Http\Controllers\HREmployee\CardRequestController;
use App\Http\Controllers\HREmployee\UserController;

Route::put('approve/{user}', [UserController::class, 'approve'])->name('users.approve');
Route::resource('users', UserController::class)->only(['index']);

Route::put('accept/{cardRequest}', [CardRequestController::class, 'accept'])->name('card-requests.accept');
Route::put('reject/{cardRequest}', [CardRequestController::class, 'reject'])->name('card-requests.reject');
Route::get('card-requests/export', [CardRequestController::class, 'export'])->name('card-requests.export');
Route::resource('card-requests', CardRequestController::class)->only(['index', 'show']);
