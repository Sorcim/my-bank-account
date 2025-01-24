<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepository
{
    public function findByMail(string $mail): ?User;


}
