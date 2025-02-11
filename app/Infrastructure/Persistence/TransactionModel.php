<?php

namespace App\Infrastructure\Persistence;

use Database\Factories\TransactionModelFactory;
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
        'checked',
        'category_id'
    ];

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccountModel::class, 'bank_account_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    protected static function newFactory(): TransactionModelFactory
    {
        return TransactionModelFactory::new();
    }
}
