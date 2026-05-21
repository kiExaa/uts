<?php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $brands   = ['Yonex', 'Li-Ning', 'Victor', 'RSL', 'Apacs', 'Flypower'];
        $products = [
            'Astrox 88S Pro', 'Nanoray 900', 'Thruster K9000',
            'Silver No.1', 'Challenger Series', 'Windstorm 72',
            'Tour Pro 9000', 'Bravesword 12',
        ];

        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'name'        => $this->faker->randomElement($brands) . ' '
                           . $this->faker->randomElement($products),
            'description' => $this->faker->paragraph(2),
            'price'       => $this->faker->randomElement([
                                49000, 85000, 120000, 250000,
                                350000, 500000, 750000, 1200000,
                                1500000, 2000000
                             ]),
            'stock'       => $this->faker->numberBetween(0, 100),
            'image'       => null,
        ];
    }
}
