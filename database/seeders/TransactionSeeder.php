<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'user_id' => 1, // Sesuaikan dengan ID user yang ada
            'account_id' => 1, // Sesuaikan dengan akun
            'category_id' => 1, // Sesuaikan dengan kategori
            'type' => 'income',
            'amount' => 500000,
            'description' => 'Gaji Bulanan',
            'transaction_date' => now(),
        ]);

        Transaction::create([
            'user_id' => 1,
            'account_id' => 1,
            'category_id' => 2,
            'type' => 'expense',
            'amount' => 150000,
            'description' => 'Belanja Bulanan',
            'transaction_date' => now(),
        ]);
    }
}
