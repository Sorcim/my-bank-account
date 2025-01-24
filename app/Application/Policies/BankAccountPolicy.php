<?php

namespace App\Application\Policies;

use App\Infrastructure\Persistence\BankAccountModel;
use App\Infrastructure\Persistence\UserModel;

class BankAccountPolicy
{
    /**
     * Détermine si l'utilisateur peut mettre à jour le compte bancaire.
     */
    public function update(UserModel $user, BankAccountModel $bankAccount)
    {
        return $user->id === $bankAccount->user_id; // Seul le créateur peut éditer
    }

    /**
     * Détermine si l'utilisateur peut supprimer le compte bancaire.
     */
    public function delete(UserModel $user, BankAccountModel $bankAccount)
    {
        return $user->id === $bankAccount->user_id; // Seul le créateur peut supprimer
    }
}
