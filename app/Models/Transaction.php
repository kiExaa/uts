<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'customer_name', 'quantity',
        'total_price', 'transaction_date', 'status'
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    // Transaksi milik satu produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
