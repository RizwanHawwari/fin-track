<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;

class BudgetPolicy
{
    public function update(User $user, Budget $budget)
    {
        return $user->id === $budget->user_id;
    }

    public function delete(User $user, Budget $budget)
    {
        return $user->id === $budget->user_id;
    }
}
