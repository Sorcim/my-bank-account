<?php

namespace App\Infrastructure\Persistence;

use Database\Factories\TransactionModelFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionModel extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'amount',
        'description',
        'effective_at',
        'bank_account_id',
        'checked'
    ];

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccountModel::class, 'bank_account_id');
    }

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value / 100,
            set: fn (string $value) => (int) round($value * 100)
        );
    }

    protected static function newFactory(): TransactionModelFactory
    {
        return TransactionModelFactory::new();
    }
}
