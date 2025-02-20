<?php

use App\Application\Controllers\Api\Authentication\ApiLoginController;
use App\Application\Controllers\Api\BankAccount\ApiGetBankAccountForCurrentUserController;
use App\Application\Controllers\Api\Category\ApiGetCategoryForCurrentUserController;
use App\Application\Controllers\Api\Transaction\ApiCreateTransactionController;
use App\Application\Controllers\Api\Transaction\ApiCreateTransactionFromImageController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiLoginController::class, 'execute'])->name('api.login');
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/transactions', [ApiCreateTransactionController::class, 'execute'])->name('api.transaction.create');
    Route::get('/bank-accounts', [ApiGetBankAccountForCurrentUserController::class, 'execute'])->name('api.bank-account.get');
    Route::get('/categories', [ApiGetCategoryForCurrentUserController::class, 'execute'])->name('api.category.get');
    Route::post('/image-transactions', [ApiCreateTransactionFromImageController::class, 'execute'])->name('api.image-transaction.create');
});
