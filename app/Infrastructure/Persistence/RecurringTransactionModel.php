<?php

namespace App\Infrastructure\Persistence;

use Database\Factories\RecurringTransactionModelFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringTransactionModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'recurring_transactions';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'amount',
        'description',
        'start_at',
        'end_at',
        'frequency',
        'last_processed_at',
        'next_processed_at',
        'category_id',
        'bank_account_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccountModel::class, 'bank_account_id');
    }

    protected static function newFactory(): RecurringTransactionModelFactory
    {
        return RecurringTransactionModelFactory::new();
    }
}
