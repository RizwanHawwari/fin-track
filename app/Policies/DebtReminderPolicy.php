<?php

namespace App\Policies;

use App\Models\DebtReminder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DebtReminderPolicy
{
    public function update(User $user, DebtReminder $debtReminder)
    {
        return $user->id === $debtReminder->user_id;
    }

    public function delete(User $user, DebtReminder $debtReminder)
    {
        return $user->id === $debtReminder->user_id;
    }
}
