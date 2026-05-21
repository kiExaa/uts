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
        // Buat 6 kategori
        Category::factory(6)->create();

        // Buat 20 produk
        Product::factory(20)->create();

        // Buat 30 transaksi
        Transaction::factory(30)->create();
    }
}
