<?php

namespace App\Models;

use App\enums\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','transaction_type','amount','fee','date'
    ];

    protected $casts = [
        'transaction_type' => TransactionTypeEnum::class,
        'amount' => 'double',
        'date' => 'date',
        'fee' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDeposits()
    {
        return $this->where('transaction_type', TransactionTypeEnum::DEPOSIT->value);
    }
}
