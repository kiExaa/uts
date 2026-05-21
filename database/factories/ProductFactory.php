<?php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $products = [
            'Raket Yonex Astrox 88S', 'Raket Li-Ning Windstorm', 'Sepatu Victor SH-P9200',
            'Shuttlecock RSL Silver', 'Tas Victor BR9200', 'Kaos Yonex Tournament',
            'Grip Yonex AC102', 'Celana Badminton Li-Ning',
        ];
        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'name'        => $this->faker->randomElement($products) . ' ' . $this->faker->bothify('##??'),
            'description' => $this->faker->paragraph(),
            'price'       => $this->faker->numberBetween(50000, 2000000),
            'stock'       => $this->faker->numberBetween(5, 100),
            'image'       => null,
        ];
    }
}
