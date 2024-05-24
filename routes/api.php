<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Name\Presentation\Api\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('customers')->name('customers.')->group(function () {
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('/{id}', [CustomerController::class, 'show'])->name('show');
});
