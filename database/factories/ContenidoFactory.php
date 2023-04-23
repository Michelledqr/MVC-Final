<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contenido>
 */
class ContenidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idprograma' => $this->faker->numberBetween(1,3),
            'semestre' => $this->faker->numberBetween(1,8),
            'idmateria' => $this->faker ->numberBetween(1,5),
            'idprofesor' => $this->faker ->numberBetween(1,2),
            'idmateriapre' => $this->faker ->numberBetween(1,5)
        ];
    }
}
