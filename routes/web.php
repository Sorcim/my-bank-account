<?php

use App\Application\Controllers\Web\Authentication\LoginController;
use App\Application\Controllers\Web\BankAccount\CreateBankAccountController;
use App\Application\Controllers\Web\BankAccount\DeleteBankAccountController;
use App\Application\Controllers\Web\BankAccount\EditBankAccountController;
use App\Application\Controllers\Web\BankAccount\ListBankAccountController;
use App\Application\Controllers\Web\Category\CreateCategoryController;
use App\Application\Controllers\Web\Category\DeleteCategoryController;
use App\Application\Controllers\Web\Category\EditCategoryController;
use App\Application\Controllers\Web\Category\ShowListCategoryController;
use App\Application\Controllers\Web\RecurringTransaction\CreateRecurringTransactionController;
use App\Application\Controllers\Web\RecurringTransaction\DeleteRecurringTransactionController;
use App\Application\Controllers\Web\RecurringTransaction\EditRecurringTransactionController;
use App\Application\Controllers\Web\RecurringTransaction\ShowListRecurringTransactionController;
use App\Application\Controllers\Web\Transaction\CreateTransactionController;
use App\Application\Controllers\Web\Transaction\CreateTransactionFromImageController;
use App\Application\Controllers\Web\Transaction\DeleteTransactionController;
use App\Application\Controllers\Web\Transaction\EditTransactionController;
use App\Application\Controllers\Web\Transaction\ShowListTransactionController;
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
    Route::group(['prefix' => 'recurring'], function () {
        Route::get('/', [ShowListRecurringTransactionController::class, 'render'])->name('recurring.list');
        Route::post('/', [CreateRecurringTransactionController::class, 'execute'])->name('recurring.create');
        Route::delete('/{id}', [DeleteRecurringTransactionController::class, 'execute'])->name('recurring.delete');
        Route::patch('/{id}', [EditRecurringTransactionController::class, 'execute'])->name('recurring.patch');
    });
});
