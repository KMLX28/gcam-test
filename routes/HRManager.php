<?php


use App\Http\Controllers\HRManager\CardRequestController;

Route::put('accept/{cardRequest}', [CardRequestController::class, 'accept'])->name('card-requests.accept');
Route::put('reject/{cardRequest}', [CardRequestController::class, 'reject'])->name('card-requests.reject');
Route::resource('card-requests', CardRequestController::class)->only(['index', 'show']);
