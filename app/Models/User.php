<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\enums\AccountTypeEnum;
use App\enums\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'account_type',
        'balance',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'account_type' => AccountTypeEnum::class,
        'balance' => 'double'
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function deposit()
    {
        return $this->transactionsType(TransactionTypeEnum::DEPOSIT->value);
    }

    public function withdrawal()
    {
        return $this->transactionsType(TransactionTypeEnum::WITHDRAWAL->value);
    }

    public function transactionsType($type)
    {
        return  $this->transactions()->where('transaction_type', $type)
            ->sum('amount');
    }

    public function currentBalance()
    {
        return $this->deposit() - $this->withdrawal();
    }
}
