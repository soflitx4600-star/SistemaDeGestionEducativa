<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Noticia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Noticia>
 */
class NoticiaFactory extends Factory
{
    protected $model = Noticia::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulo = fake()->unique()->sentence(4);

        return [
            'titulo' => $titulo,
            'slug' => Str::slug($titulo),
            'descripcion' => fake()->paragraph(),
            'contenido' => fake()->paragraphs(3, asText: true),
            'categoria_id' => Categoria::factory(),
            'activa' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'activa' => false,
        ]);
    }
}
