<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Makan & Minum', 'description' => 'Pengeluaran untuk makanan dan minuman', 'is_default' => true],
            ['name' => 'Transportasi', 'description' => 'Biaya transportasi harian', 'is_default' => true],
            ['name' => 'Belanja', 'description' => 'Pengeluaran belanja pribadi atau rumah tangga', 'is_default' => true],
            ['name' => 'Hiburan', 'description' => 'Pengeluaran untuk rekreasi dan hiburan', 'is_default' => true],
            ['name' => 'Kesehatan', 'description' => 'Biaya kesehatan dan obat-obatan', 'is_default' => true],
            ['name' => 'Pendidikan', 'description' => 'Biaya pendidikan, kursus, dan buku', 'is_default' => true],
            ['name' => 'Tagihan & Utilitas', 'description' => 'Pembayaran listrik, air, internet, dll.', 'is_default' => true],
            ['name' => 'Investasi', 'description' => 'Dana yang dialokasikan untuk investasi', 'is_default' => true],
            ['name' => 'Tabungan', 'description' => 'Dana yang disisihkan untuk tabungan', 'is_default' => true],
            ['name' => 'Lain-lain', 'description' => 'Kategori lain yang tidak termasuk di atas', 'is_default' => true],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
