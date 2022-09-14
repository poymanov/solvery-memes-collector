<?php

namespace Database\Factories;

use App\Enums\MemeSourceTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meme>
 */
class MemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'external_id'  => $this->faker->uuid(),
            'source_type'  => MemeSourceTypeEnum::VK->value,
            'source_alias' => $this->faker->text,
            'text'         => $this->faker->text(),
        ];
    }
}
