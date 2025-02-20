<?php

namespace App\Domain\ValueObjects;

use App\Domain\Entities\User;

final class AuthenticationResult
{
    private function __construct(
        private readonly bool $isSuccessful,
        private readonly ?User $user = null,
        private readonly ?string $failureReason = null
    ) {}

    public static function success(User $user): self
    {
        return new self(true, $user);
    }

    public static function failure(string $reason = 'Invalid credentials'): self
    {
        return new self(false, null, $reason);
    }

    public function isSuccessful(): bool
    {
        return $this->isSuccessful;
    }

    public function user(): ?User
    {
        return $this->user;
    }

    public function failureReason(): ?string
    {
        return $this->failureReason;
    }
}