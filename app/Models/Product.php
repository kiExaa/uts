<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'price', 'stock', 'image'];

    // Relasi: produk milik 1 kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: 1 produk punya banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
