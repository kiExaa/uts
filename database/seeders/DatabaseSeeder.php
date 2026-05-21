<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 6 kategori terlebih dahulu
        Category::factory(6)->create();

        // 2. Buat 20 produk (masing-masing link ke kategori acak)
        Product::factory(20)->create();

        // 3. Buat 30 transaksi (masing-masing link ke produk acak)
        Transaction::factory(30)->create();
    }
}
