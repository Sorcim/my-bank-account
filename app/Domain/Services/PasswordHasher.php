<?php

namespace App\Domain\Services;

interface PasswordHasher
{
    public function hash(string $password): string;

    public function verify(string $password, string $hashedPassword): bool;
}
