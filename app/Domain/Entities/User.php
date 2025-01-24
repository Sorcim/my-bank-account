<?php

namespace App\Domain\Entities;

class User
{

    public function __construct(
        public readonly string $id,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}
