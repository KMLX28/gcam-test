<?php

use App\Http\Controllers\EmployeeCardController;
use App\Http\Controllers\User\CardRequestController;

Route::get('employee-cards/download', [EmployeeCardController::class, 'download'])->name('employee-cards.download');
Route::resource('employee-cards', EmployeeCardController::class)->only(['index']);
Route::resource('card-requests', CardRequestController::class)->only(['create', 'store']);
