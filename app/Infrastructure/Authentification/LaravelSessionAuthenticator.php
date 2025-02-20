<?php

namespace App\Infrastructure\Authentification;

use App\Domain\Entities\User;
use App\Domain\Services\SessionAuthenticator;
use App\Infrastructure\Persistence\UserModel;

class LaravelSessionAuthenticator implements SessionAuthenticator
{
    public function login(User $user): void
    {
        $userModel = UserModel::find($user->id);
        auth()->login($userModel);
    }

    public function logout(): void
    {
        auth()->logout();
    }

    public function check(): bool
    {
        return auth()->check();
    }
}
