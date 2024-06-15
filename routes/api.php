<?php

use App\Http\Controllers\PaymentController;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([ForceJsonResponse::class])->group(function () {
    Route::post('/payments', [PaymentController::class, 'store']);
});
