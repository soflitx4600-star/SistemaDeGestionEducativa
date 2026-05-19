<?php

namespace Database\Factories;

use App\Models\Consulta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Consulta>
 */
class ConsultaFactory extends Factory
{
    protected $model = Consulta::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_completo' => fake()->name(),
            'correo_electronico' => fake()->safeEmail(),
            'telefono' => fake()->phoneNumber(),
            'asunto' => fake()->sentence(3),
            'mensaje' => fake()->paragraph(),
            'estado' => 'pendiente',
        ];
    }

    public function resuelto(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'resuelto',
        ]);
    }
}
