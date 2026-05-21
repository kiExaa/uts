<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Raket', 'Sepatu', 'Shuttlecock', 'Tas', 'Kaos', 'Celana', 'Grip', 'Stringing'];
        return [
            'name'        => $this->faker->unique()->randomElement($categories),
            'description' => $this->faker->sentence(),
        ];
    }
}
