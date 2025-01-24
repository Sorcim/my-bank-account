<?php

namespace App\Domain\UseCases\Authentication;

use App\Domain\Repositories\UserRepository;

class LoginUser
{
    public function __construct(
        public readonly UserRepository $userRepository
    )
    {}

    public function execute($email, $password) : bool
    {
        $user = $this->userRepository->findByMail($email);
        if(!$user){
            return false;
        }
        return password_verify($password, $user->password);
    }
}
