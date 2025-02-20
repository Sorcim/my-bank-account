<?php

namespace App\Infrastructure\Framework\Providers;

use App\Application\Policies\BankAccountPolicy;
use App\Domain\Repositories\BankAccountRepository;
use App\Domain\Repositories\CategoryRepository;
use App\Domain\Repositories\RecurringTransactionRepository;
use App\Domain\Repositories\TransactionRepository;
use App\Domain\Repositories\UserRepository;
use App\Domain\Services\ImageProcessingInterface;
use App\Domain\Services\PasswordHasher;
use App\Domain\Services\SessionAuthenticator;
use App\Domain\Services\TokenGenerator;
use App\Domain\Services\TransactionProcessingInterface;
use App\Infrastructure\Authentification\LaravelSessionAuthenticator;
use App\Infrastructure\Authentification\SanctumTokenGenerator;
use App\Infrastructure\Persistence\BankAccountModel;
use App\Infrastructure\Repositories\Eloquent\EloquentBankAccountRepository;
use App\Infrastructure\Repositories\Eloquent\EloquentCategoryRepository;
use App\Infrastructure\Repositories\Eloquent\EloquentRecurringTransactionRepository;
use App\Infrastructure\Repositories\Eloquent\EloquentTransactionRepository;
use App\Infrastructure\Repositories\Eloquent\EloquentUserRepository;
use App\Infrastructure\Security\Argon2PasswordHasher;
use App\Infrastructure\Services\OpenAIImageProcessingService;
use App\Infrastructure\Services\TransactionProcessingService;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $this->app->bind(ImageProcessingInterface::class, OpenAIImageProcessingService::class);
        $this->app->bind(TransactionProcessingInterface::class, TransactionProcessingService::class);
        $this->app->bind(RecurringTransactionRepository::class, EloquentRecurringTransactionRepository::class);
        $this->app->bind(PasswordHasher::class, Argon2PasswordHasher::class);
        $this->app->bind(TokenGenerator::class, SanctumTokenGenerator::class);
        $this->app->bind(SessionAuthenticator::class, LaravelSessionAuthenticator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
        Gate::policy(BankAccountModel::class, BankAccountPolicy::class);
    }
}
