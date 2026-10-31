<?php

namespace Database\Factories;

use App\Models\Developer;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->sentence(2),
            'description' => fake()->paragraph(),
            'user_id' => User::factory(),
            'developer_id' => Developer::create(['name' => fake()->company()])->id,
        ];
    }
}
