<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('nombre');
     * $table->Unsigned('ruta');
     * $table->integer('project_id');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->word(),
            'ruta'=>fake()->filePath(),
            'project_id'=>fake()->numberBetween(1,150),
        ];
    }
}
