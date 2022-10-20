<?php

namespace Database\Factories;

use App\Models\CoolWord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoolWord\CoolWord>
 */
class CoolWordFactory extends Factory
{
    protected $model = CoolWord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'views' => 0,
            'description' => $this->faker->text()
        ];
    }
}
