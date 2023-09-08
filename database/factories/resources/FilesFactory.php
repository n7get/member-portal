<?php

namespace Database\Factories\resources;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FilesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'mime_type' => $this->faker->mimeType(),
            'type' => $this->faker->randomElement(['public', 'member', 'leadership']),
            'data' => $this->faker->text(),
        ];
    }
}
