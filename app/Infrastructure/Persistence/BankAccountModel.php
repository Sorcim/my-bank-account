<?php

namespace App\Infrastructure\Persistence;

use Database\Factories\BankAccountModelFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

//    protected function startBalance(): Attribute
//    {
//        return Attribute::make(
//            get: fn (string $value) => $value / 100,
//            set: fn (string $value) => (int) round($value * 100)
//        );
//    }

    public function latestTransaction(): HasOne
    {
        return $this->hasOne(TransactionModel::class, 'bank_account_id')->latestOfMany();
    }

    protected static function newFactory(): BankAccountModelFactory
    {
        return BankAccountModelFactory::new();
    }
}
