<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Raket', 'Sepatu Badminton', 'Shuttlecock',
            'Tas Badminton', 'Kaos Olahraga', 'Celana Badminton',
            'Grip', 'Stringing Service'
        ];

        return [
            'name'        => $this->faker->unique()->randomElement($categories),
            'description' => $this->faker->sentence(10),
        ];
    }
}
