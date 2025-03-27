<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    public function update(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->user_id;
    }

    public function delete(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->user_id;
    }
}
