<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Ad $ad) {
            $ad->categories()->attach(Category::all()->random(rand(1, 5)));
            $ad->save();
        });
    }
}
