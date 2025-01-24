<?php

use App\Application\Controllers\Authentication\LoginController;
use App\Application\Controllers\BankAccount\CreateBankAccountController;
use App\Application\Controllers\BankAccount\DeleteBankAccountController;
use App\Application\Controllers\BankAccount\EditBankAccountController;
use App\Application\Controllers\BankAccount\ListBankAccountController;
use App\Application\Controllers\Category\CreateCategoryController;
use App\Application\Controllers\Category\DeleteCategoryController;
use App\Application\Controllers\Category\EditCategoryController;
use App\Application\Controllers\Category\ShowListCategoryController;
use App\Application\Controllers\Transaction\CreateTransactionController;
use App\Application\Controllers\Transaction\CreateTransactionFromImageController;
use App\Application\Controllers\Transaction\DeleteTransactionController;
use App\Application\Controllers\Transaction\EditTransactionController;
use App\Application\Controllers\Transaction\ShowListTransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'render'])->name('login');
Route::post('/login', [LoginController::class, 'execute'])->name('login.execute');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [ListBankAccountController::class, 'render'])->name('home');
    Route::group(['prefix' => 'bank-accounts'], function () {
        Route::post('/', [CreateBankAccountController::class, 'execute'])->name('bank-account.create');
        Route::get('/{id}', [ShowListTransactionController::class, 'render'])->name('bank-account.show');
        Route::patch('/{id}', [EditBankAccountController::class, 'execute'])->name('bank-account.patch');
        Route::delete('/{id}', [DeleteBankAccountController::class, 'execute'])->name('bank-account.delete');

        Route::post('/{id}/import-transaction', [CreateTransactionFromImageController::class, 'execute'])->name('transaction.import');
    });

    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', [ShowListTransactionController::class, 'render'])->name('transaction.list');

        Route::post('/', [CreateTransactionController::class, 'execute'])->name('transaction.create');
        Route::post('/receipts', [CreateTransactionFromImageController::class, 'execute'])->name('transaction.import');
        Route::patch('/{id}', [EditTransactionController::class, 'execute'])->name('transaction.patch');
        Route::delete('/{id}', [DeleteTransactionController::class, 'execute'])->name('transaction.delete');
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [ShowListCategoryController::class, 'render'])->name('category.list');
        Route::post('/', [CreateCategoryController::class, 'execute'])->name('category.create');
        Route::patch('/{id}', [EditCategoryController::class, 'execute'])->name('category.patch');
        Route::delete('/{id}', [DeleteCategoryController::class, 'execute'])->name('category.delete');
    });
});
