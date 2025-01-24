<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;
use App\Infrastructure\Persistence\UserModel;

class EloquentUserRepository implements UserRepository
{
    public function findByMail(string $mail): ?User
    {
         $user = UserModel::where('email', $mail)->first();
            if (!$user) {
                return null;
            }
            return new User(
                $user->id,
                $user->email,
                $user->password
            );
    }
}
