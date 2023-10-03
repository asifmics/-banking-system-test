<?php

namespace App\Models;

use App\enums\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','transaction_type','amount','fee','date'
    ];

    protected $casts = [
        'transaction_type' => TransactionTypeEnum::class,
        'amount' => 'double',
        'fee' => 'decimal',
        'date' => 'date',
    ];
}
