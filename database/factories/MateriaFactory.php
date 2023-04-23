<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materia>
 */
class MateriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'creditos' => $this->faker->numberBetween(2,5),
            'horasguia' => $this->faker ->numberBetween(20,40),
            'horasauto' => $this->faker ->numberBetween(20,40)
        ];
    }
}
