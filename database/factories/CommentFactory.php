<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('contenido');
     * $table->integer('user_id');
     * $table->integer('project_id');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contenido'=>fake()->words(5, true),
            'user_id'=>fake()->numberBetween(1,160),
            'project_id'=>fake()->numberBetween(1,150),
        ];
    }
}
