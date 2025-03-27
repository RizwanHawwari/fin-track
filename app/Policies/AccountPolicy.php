<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;

class AccountPolicy
{
    /**
     * Determine whether the user can view any accounts.
     */
    public function viewAny(User $user): bool
    {
        return true; // Semua user bisa lihat daftar akun
    }

    /**
     * Determine whether the user can view the account.
     */
    public function view(User $user, Account $account): bool
    {
        return $user->id === $account->user_id; // Hanya pemilik akun yang bisa lihat
    }

    /**
     * Determine whether the user can create accounts.
     */
    public function create(User $user): bool
    {
        return true; // Semua user boleh buat akun
    }

    /**
     * Determine whether the user can update the account.
     */
    public function update(User $user, Account $account): bool
    {
        return $user->id === $account->user_id; // Hanya pemilik akun yang boleh edit
    }

    /**
     * Determine whether the user can delete the account.
     */
    public function delete(User $user, Account $account): bool
    {
        return $user->id === $account->user_id; // Hanya pemilik akun yang boleh hapus
    }
}
