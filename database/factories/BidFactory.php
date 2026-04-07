<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bid>
 */
class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ad = Ad::inRandomOrder()->first();
    
        $user = User::where('id', '!=', $ad->user_id)->inRandomOrder()->first();

        return [
            'ad_id' => $ad->id,
            'user_id' => $user->id,
            'price' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
