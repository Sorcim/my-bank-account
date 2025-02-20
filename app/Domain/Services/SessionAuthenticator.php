<?php

namespace App\Domain\Services;

use App\Domain\Entities\User;

interface SessionAuthenticator
{
    public function login(User $user): void;

    public function logout(): void;

    public function check(): bool;
}
