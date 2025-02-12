<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\CreditCardExpense;

class Cashbox extends Model
{
    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }

    public function creditCardExpenses()
    {
        return $this->hasManyThrough(CreditCardExpense::class, Wallet::class);
    }

    public function getTotalExpensesAttribute()
    {
        $withdrawals = $this->transactions()->where('transaction_type', 'withdrawal')->sum('amount');
        $creditCardExpenses = $this->creditCardExpenses()->sum('amount');
        return $withdrawals + $creditCardExpenses;
    }
}
