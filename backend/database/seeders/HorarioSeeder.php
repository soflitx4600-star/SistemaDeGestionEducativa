<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Materia;
use App\Models\PlanDeEstudio;
use Illuminate\Database\Seeder;

/**
 * Carga datos reales del horario del
 * "Colegio Secundario Olga Márquez de Aredez N°59"
 * — 1ro 7ma (Tarde) y 1ro 8va (Tarde), Ciclo Lectivo 2026.
 */
class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Plan de Estudios ────────────────────────────────────────────────
        $plan = PlanDeEstudio::firstOrCreate(
            ['nombre' => 'Plan General Secundaria'],
            ['descripcion' => 'Plan de estudios general del Colegio N°59']
        );

        // ─── Materias ────────────────────────────────────────────────────────
        $materias = collect([
            'Cs. Biológicas',
            'Matemática',
            'Lengua',
            'Historia',
            'Geografía',
            'Física',
            'Química',
            'Ed. Física',
            'Inglés',
            'Cs. Sociales',
            'Formación Ética',
        ])->mapWithKeys(fn($nombre) => [
            $nombre => Materia::firstOrCreate(
                ['nombre' => $nombre, 'plan_de_estudio_id' => $plan->id],
                ['ciclo' => 'comun', 'anio_cursado' => 1, 'horas_semanales' => 3]
            ),
        ]);

        // ─── Docentes ────────────────────────────────────────────────────────
        // Datos reales del horario del Colegio N°59
        $docentesData = [
            // 1ro 7ma (Turno Tarde)
            ['apellido' => 'Tejerina',   'nombre' => 'Alejandra'], // Cs. Biológicas
            ['apellido' => 'Paz',        'nombre' => 'Martin'],    // Matemática
            ['apellido' => 'Sandoval',   'nombre' => 'Claudia'],   // Lengua
            // 1ro 8va (Turno Tarde)
            ['apellido' => 'Cruz',       'nombre' => 'Cecilia'],   // Historia
            ['apellido' => 'Guerrero',   'nombre' => 'Adriana'],   // Geografía
            ['apellido' => 'Benicio',    'nombre' => 'Marcela'],   // Matemática
        ];

        $docentes = collect($docentesData)->mapWithKeys(function($d, $index) {
            return [
                "{$d['apellido']}_{$d['nombre']}" => Docente::firstOrCreate(
                    ['apellido' => $d['apellido'], 'nombre' => $d['nombre']],
                    [
                        'dni'   => '2500000' . $index,
                        'email' => strtolower("{$d['nombre']}.{$d['apellido']}@n59.edu.ar"),
                    ]
                )
            ];
        });

        // ─── Cursos ──────────────────────────────────────────────────────────
        // 1ro 7ma — Turno Tarde — Preceptor: Cruz, Angel
        $curso7ma = Curso::firstOrCreate(
            ['anio' => 1, 'division' => '7ma', 'ciclo_lectivo' => 2026],
            [
                'plan_de_estudio_id' => $plan->id,
                'turno'              => 'Tarde',
                'preceptor'          => 'Cruz, Angel',
                'cupo_maximo'        => 30,
            ]
        );

        // 1ro 8va — Turno Tarde — Preceptora: Valdiviezo, Mabel
        $curso8va = Curso::firstOrCreate(
            ['anio' => 1, 'division' => '8va', 'ciclo_lectivo' => 2026],
            [
                'plan_de_estudio_id' => $plan->id,
                'turno'              => 'Tarde',
                'preceptor'          => 'Valdiviezo, Mabel',
                'cupo_maximo'        => 30,
            ]
        );

        // ─── Horarios 1ro 7ma ────────────────────────────────────────────────
        // Basado en el horario real del Word institucional
        $horarios7ma = [
            ['dia' => 'Lunes',     'hora' => 1, 'materia' => 'Cs. Biológicas', 'docente' => 'Tejerina_Alejandra'],
            ['dia' => 'Lunes',     'hora' => 2, 'materia' => 'Matemática',      'docente' => 'Paz_Martin'],
            ['dia' => 'Lunes',     'hora' => 3, 'materia' => 'Matemática',      'docente' => 'Paz_Martin'],
            ['dia' => 'Martes',    'hora' => 1, 'materia' => 'Lengua',          'docente' => 'Sandoval_Claudia'],
            ['dia' => 'Martes',    'hora' => 2, 'materia' => 'Lengua',          'docente' => 'Sandoval_Claudia'],
            ['dia' => 'Miércoles', 'hora' => 1, 'materia' => 'Cs. Biológicas', 'docente' => 'Tejerina_Alejandra'],
            ['dia' => 'Miércoles', 'hora' => 2, 'materia' => 'Cs. Biológicas', 'docente' => 'Tejerina_Alejandra'],
            ['dia' => 'Jueves',    'hora' => 1, 'materia' => 'Lengua',          'docente' => 'Sandoval_Claudia'],
            ['dia' => 'Jueves',    'hora' => 2, 'materia' => 'Matemática',      'docente' => 'Paz_Martin'],
            ['dia' => 'Viernes',   'hora' => 1, 'materia' => 'Matemática',      'docente' => 'Paz_Martin'],
            ['dia' => 'Viernes',   'hora' => 2, 'materia' => 'Lengua',          'docente' => 'Sandoval_Claudia'],
        ];

        // ─── Horarios 1ro 8va ────────────────────────────────────────────────
        $horarios8va = [
            ['dia' => 'Lunes',     'hora' => 1, 'materia' => 'Historia',   'docente' => 'Cruz_Cecilia'],
            ['dia' => 'Lunes',     'hora' => 2, 'materia' => 'Geografía',  'docente' => 'Guerrero_Adriana'],
            ['dia' => 'Lunes',     'hora' => 3, 'materia' => 'Geografía',  'docente' => 'Guerrero_Adriana'],
            ['dia' => 'Martes',    'hora' => 1, 'materia' => 'Matemática', 'docente' => 'Benicio_Marcela'],
            ['dia' => 'Martes',    'hora' => 2, 'materia' => 'Matemática', 'docente' => 'Benicio_Marcela'],
            ['dia' => 'Martes',    'hora' => 3, 'materia' => 'Historia',   'docente' => 'Cruz_Cecilia'],
            ['dia' => 'Miércoles', 'hora' => 1, 'materia' => 'Geografía',  'docente' => 'Guerrero_Adriana'],
            ['dia' => 'Miércoles', 'hora' => 2, 'materia' => 'Historia',   'docente' => 'Cruz_Cecilia'],
            ['dia' => 'Jueves',    'hora' => 1, 'materia' => 'Matemática', 'docente' => 'Benicio_Marcela'],
            ['dia' => 'Jueves',    'hora' => 2, 'materia' => 'Matemática', 'docente' => 'Benicio_Marcela'],
            ['dia' => 'Viernes',   'hora' => 1, 'materia' => 'Historia',   'docente' => 'Cruz_Cecilia'],
            ['dia' => 'Viernes',   'hora' => 2, 'materia' => 'Geografía',  'docente' => 'Guerrero_Adriana'],
        ];

        // ─── Persistir horarios ──────────────────────────────────────────────
        foreach ($horarios7ma as $h) {
            Horario::updateOrCreate(
                [
                    'curso_id'     => $curso7ma->id,
                    'dia_semana'   => $h['dia'],
                    'hora_catedra' => $h['hora'],
                ],
                [
                    'materia_id' => $materias[$h['materia']]->id,
                    'docente_id' => $docentes[$h['docente']]->id,
                ]
            );
        }

        foreach ($horarios8va as $h) {
            Horario::updateOrCreate(
                [
                    'curso_id'     => $curso8va->id,
                    'dia_semana'   => $h['dia'],
                    'hora_catedra' => $h['hora'],
                ],
                [
                    'materia_id' => $materias[$h['materia']]->id,
                    'docente_id' => $docentes[$h['docente']]->id,
                ]
            );
        }

        $this->command->info('✅ HorarioSeeder: 1ro 7ma y 1ro 8va cargados con datos reales del Colegio N°59.');
    }
}
