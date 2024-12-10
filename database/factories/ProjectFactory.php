<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('nombre');
     * $table->string('descripcion');
     * $table->integer('estudiante_id');
     * $table->integer('profesor_id');
     * $table->string('estado');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->word(),
            'descripcion'=>fake()->words(3,true),
            'estudiante_id'=>fake()->numberBetween(1,100),
            'profesor_id'=>fake()->numberBetween(1,60),
            'estado'=>fake()->randomElement(['Activo', 'Completado']),
        ];
    }
}
