<?php

namespace App\Infrastructure\Framework\Providers;

use App\Application\Policies\BankAccountPolicy;
use App\Domain\Repositories\BankAccountRepository;
use App\Domain\Repositories\CategoryRepository;
use App\Domain\Repositories\TransactionRepository;
use App\Domain\Repositories\UserRepository;
use App\Domain\Services\ImageProcessingService;
use App\Infrastructure\Persistence\BankAccountModel;
use App\Infrastructure\Repositories\Eloquent\EloquentBankAccountRepository;
use App\Infrastructure\Repositories\Eloquent\EloquentCategoryRepository;
use App\Infrastructure\Repositories\Eloquent\EloquentTransactionRepository;
use App\Infrastructure\Repositories\Eloquent\EloquentUserRepository;
use App\Infrastructure\Services\OpenAIImageProcessingService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(BankAccountRepository::class, EloquentBankAccountRepository::class);
        $this->app->bind(TransactionRepository::class, EloquentTransactionRepository::class);
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(ImageProcessingService::class, OpenAIImageProcessingService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(BankAccountModel::class, BankAccountPolicy::class);
    }
}
