<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            'user_id' => 1, // Sesuai dengan ID dari UserSeeder
            'name' => 'Bank BCA',
            'balance' => 5000000,
            'type' => 'bank',
        ]);

        Account::create([
            'user_id' => 2,
            'name' => 'E-Wallet OVO',
            'balance' => 2000000,
            'type' => 'e-wallet',
        ]);
    }
}
