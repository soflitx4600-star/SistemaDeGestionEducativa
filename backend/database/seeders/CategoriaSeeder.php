<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Ciencias'],
            ['nombre' => 'Deportes'],
            ['nombre' => 'Cultura'],
            ['nombre' => 'Comunidad'],
            ['nombre' => 'Institucional'],
            ['nombre' => 'General'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate([
                'nombre' => $categoria['nombre'],
            ], $categoria);
        }
    }
}
