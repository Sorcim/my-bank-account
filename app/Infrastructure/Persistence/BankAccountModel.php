<?php

namespace App\Infrastructure\Persistence;

use Database\Factories\BankAccountModelFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BankAccountModel extends Model
{
    /** @use HasFactory<BankAccountModelFactory> */
    use HasFactory, HasUuids;

    /**
     * Le nom de la table associée au modèle.
     */
    protected $table = 'bank_accounts';

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'user_id',
        'name',
        'start_balance',
    ];

    /**
     * Relations : un compte appartient à un utilisateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(TransactionModel::class, 'bank_account_id');
    }

    public function recurringTransactions(): HasMany
    {
        return $this->hasMany(RecurringTransactionModel::class, 'bank_account_id');
    }

    public function latestTransactionDate(): ?\DateTimeImmutable
    {
        $transaction = $this->hasOne(TransactionModel::class, 'bank_account_id')->latest('effective_at')->first();

        return $transaction ? new \DateTimeImmutable($transaction->effective_at) : null;
    }

    public function currentBalance(): int
    {
        return $this->start_balance +
            (int) $this->transactions()->sum('amount');
    }

    protected static function newFactory(): BankAccountModelFactory
    {
        return BankAccountModelFactory::new();
    }
}
