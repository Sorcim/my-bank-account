<?php

namespace App\Domain\Services;

use App\Domain\Entities\User;

interface TokenGenerator
{
    public function generate(User $user, string $deviceName = 'default'): string;
}
