<?php

namespace Database\Seeders;

use App\Models\Noticia;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NoticiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categoria::all();
        if ($categorias->isEmpty()) {
            $this->call(CategoriaSeeder::class);
            $categorias = Categoria::all();
        }

        $noticias = [
            [
                'titulo' => 'Feria de Innovación y Tecnología 2023',
                'descripcion' => 'Estudiantes de ciclo orientado presentaron proyectos de robótica aplicada a la sustentabilidad urbana.',
                'contenido' => 'Estudiantes de ciclo orientado presentaron proyectos de robótica aplicada a la sustentabilidad urbana. Durante tres días, más de 40 equipos expusieron sus desarrollos ante un jurado compuesto por docentes, ingenieros y representantes de empresas tecnológicas de la región. Los proyectos abarcaron desde sistemas de riego inteligente hasta prototipos de clasificación de residuos con visión artificial. La feria contó con la participación de más de 500 visitantes entre familias, alumnos de otras instituciones y autoridades educativas.',
                'categoria_id' => $categorias->where('nombre', 'Ciencias')->first()?->id ?? 1,
                'activa' => true,
            ],
            [
                'titulo' => 'Finales Intercolegiales de Atletismo',
                'descripcion' => 'Nuestros atletas destacaron en las competencias regionales obteniendo el primer puesto en relevos.',
                'contenido' => 'Nuestros atletas destacaron en las competencias regionales obteniendo el primer puesto en relevos. El equipo de atletismo de la institución participó en las finales intercolegiales celebradas en el estadio municipal, donde compitieron más de 20 escuelas de la provincia. Además del primer puesto en la prueba de relevos 4×100, se obtuvieron medallas en salto en largo y lanzamiento de bala. El entrenador destacó el esfuerzo y la dedicación del grupo durante todo el año.',
                'categoria_id' => $categorias->where('nombre', 'Deportes')->first()?->id ?? 2,
                'activa' => true,
            ],
            [
                'titulo' => 'Festival de Artes Escénicas 2023',
                'descripcion' => 'Espectáculo anual donde los alumnos muestran sus talentos en danza, teatro y música.',
                'contenido' => 'El festival de artes escénicas es uno de los eventos más esperados del año. Estudiantes de todos los niveles participaron con piezas musicales, coreografías de danza folclórica y contemporánea, y obras teatrales. El evento se realizó ante más de 1000 espectadores en el auditorio principal. La calidad de las presentaciones reflejó el trabajo realizado durante todo el año en los talleres artísticos.',
                'categoria_id' => $categorias->where('nombre', 'Cultura')->first()?->id ?? 3,
                'activa' => true,
            ],
            [
                'titulo' => 'Jornada de Puertas Abiertas',
                'descripcion' => 'Familias y futuros estudiantes conocen nuestras instalaciones y propuesta educativa.',
                'contenido' => 'La jornada de puertas abiertas permite que familias de la comunidad visiten la institución, conozcan las aulas, laboratorios, biblioteca y demás espacios. Docentes y alumnos explican la propuesta educativa, actividades extracurriculares y oportunidades de aprendizaje. Es una excelente oportunidad para que interesados en ingresar a la escuela conozcan la institución.',
                'categoria_id' => $categorias->where('nombre', 'Comunidad')->first()?->id ?? 4,
                'activa' => true,
            ],
            [
                'titulo' => 'Acto de Inicio del Ciclo Lectivo 2024',
                'descripcion' => 'Ceremonia oficial de bienvenida a todos los niveles educativos.',
                'contenido' => 'El acto de inicio del ciclo lectivo 2024 reunió a toda la comunidad educativa. Se entonó el himno nacional, se realizaron reflexiones sobre los objetivos del año y se presentaron los nuevos integrantes del equipo docente. El rector enfatizó la importancia de la educación de calidad y el compromiso institucional con la formación integral de los estudiantes.',
                'categoria_id' => $categorias->where('nombre', 'Institucional')->first()?->id ?? 5,
                'activa' => true,
            ],
        ];

        foreach ($noticias as $noticia) {
            Noticia::create([
                'titulo' => $noticia['titulo'],
                'slug' => Str::slug($noticia['titulo']),
                'descripcion' => $noticia['descripcion'],
                'contenido' => $noticia['contenido'],
                'categoria_id' => $noticia['categoria_id'],
                'activa' => $noticia['activa'],
            ]);
        }
    }
}
