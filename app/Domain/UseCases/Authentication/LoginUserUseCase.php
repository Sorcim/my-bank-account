<?php

namespace App\Domain\UseCases\Authentication;

use App\Domain\Repositories\UserRepository;
use App\Domain\Services\PasswordHasher;
use App\Domain\ValueObjects\AuthenticationResult;

class LoginUserUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private PasswordHasher $passwordHasher,
    ) {}

    public function execute($email, $password): ?AuthenticationResult
    {
        $user = $this->userRepository->findByMail($email);
        if (! $user) {
            return AuthenticationResult::failure();
        }
        if (! $this->passwordHasher->verify($password, $user->password)) {
            return AuthenticationResult::failure();
        }

        return AuthenticationResult::success($user);
    }
}
