<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;


class Wallet extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'is_active',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getBalanceAttribute()
    {
        $deposits = $this->transactions()->where('transaction_type', 'deposit')->sum('amount');
        $withdrawals = $this->transactions()->where('transaction_type', 'withdrawal')->sum('amount');
        return $deposits - $withdrawals;
    }


}
