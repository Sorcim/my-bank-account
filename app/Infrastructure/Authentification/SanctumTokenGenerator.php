<?php

namespace App\Infrastructure\Authentification;

use App\Domain\Entities\User;
use App\Domain\Services\TokenGenerator;
use App\Infrastructure\Persistence\UserModel;

class SanctumTokenGenerator implements TokenGenerator
{
    public function generate(User $user, string $deviceName = 'default'): string
    {
        $userModel = UserModel::find($user->id);

        return $userModel->createToken($deviceName)->plainTextToken;
    }
}
