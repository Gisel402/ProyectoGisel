<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     *
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     * $table->string('nombre');
     * $table->string('email')->unique();
     * $table->string('password');
     * $table->string('rol');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'password'=>static::$password ??= Hash::make('password'),
            'rol'=>fake()->randomElement(['profesor', 'estudiante']),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }


}
