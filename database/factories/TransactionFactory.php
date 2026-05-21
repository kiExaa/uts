<?php
namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $product  = Product::inRandomOrder()->first();
        $quantity = $this->faker->numberBetween(1, 5);
        $total    = $product ? $product->price * $quantity : 100000;

        return [
            'product_id'       => $product?->id ?? 1,
            'customer_name'    => $this->faker->name(),
            'quantity'         => $quantity,
            'total_price'      => $total,
            'transaction_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'status'           => $this->faker->randomElement(['pending', 'success', 'cancelled']),
        ];
    }
}
