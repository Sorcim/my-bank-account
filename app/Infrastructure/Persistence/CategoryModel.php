<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryModel extends Model
{
    use HasUuids;

    protected $table = 'categories';
    protected $fillable = ['name', 'color', 'user_id'];

    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(TransactionModel::class, 'category_id');
    }
}
