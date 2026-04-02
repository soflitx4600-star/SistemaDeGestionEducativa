<?php

namespace App\Filament\Resources\Cursos\Pages;

use App\Filament\Resources\Cursos\CursoResource;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Materia;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class GrillaHorario extends Page
{
    protected static string $resource = CursoResource::class;
    protected string $view = 'filament.resources.cursos.pages.grilla-horario';
    protected static ?string $title = 'Grilla de Horarios';

    /** @var int ID del curso actual */
    public int $record;

    /**
     * Grilla indexada por "{dia}_{hora}" → ['horario_id', 'materia_id', 'docente_id']
     * Se popula en mount() y se actualiza en guardarCelda().
     */
    public array $grilla = [];

    public static array $dias    = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
    public static array $horas   = [1, 2, 3, 4, 5, 6, 7];
    public static array $bloques = [
        1 => '13:30 - 14:10',
        2 => '14:10 - 14:50',
        3 => '14:50 - 15:30',
        4 => '15:30 - 16:10',
        5 => '16:10 - 16:50',
        6 => '16:50 - 17:30',
        7 => '17:30 - 18:10',
    ];
    public static array $etiquetasHora = [
        1 => '1ra', 2 => '2da', 3 => '3ra', 4 => '4ta',
        5 => '5ta', 6 => '6ta', 7 => '7ma',
    ];

    // ─── Ciclo de vida ───────────────────────────────────────────────────────

    public function mount(int|string $record): void
    {
        $this->record = (int) $record;
        $this->cargarGrilla();
    }

    // ─── Helpers públicos para la vista ──────────────────────────────────────

    /**
     * Devuelve el curso con su plan de estudio para el encabezado.
     */
    public function getCurso(): Curso
    {
        return Curso::with('planDeEstudio')->findOrFail($this->record);
    }

    /**
     * Materias ordenadas: id → nombre
     */
    public function getMaterias(): array
    {
        return Materia::orderBy('nombre')
            ->pluck('nombre', 'id')
            ->toArray();
    }

    /**
     * Docentes ordenados: id → "Apellido, Nombre"
     */
    public function getDocentes(): array
    {
        return Docente::orderBy('apellido')
            ->orderBy('nombre')
            ->get()
            ->pluck('nombre_completo', 'id')
            ->toArray();
    }

    /**
     * Cuenta de alumnos inscriptos en este curso (vía HistorialAcademico).
     */
    public function getAlumnosCount(): int
    {
        return $this->getCurso()->alumnos_count;
    }

    // ─── Lógica de carga/guardado ────────────────────────────────────────────

    private function cargarGrilla(): void
    {
        $horarios = Horario::with(['materia', 'docente'])
            ->where('curso_id', $this->record)
            ->get()
            ->keyBy(fn($h) => "{$h->dia_semana}_{$h->hora_catedra}");

        foreach (self::$dias as $dia) {
            foreach (self::$horas as $hora) {
                $key     = "{$dia}_{$hora}";
                $horario = $horarios->get($key);

                $this->grilla[$key] = [
                    'horario_id' => $horario?->id,
                    'materia_id' => $horario?->materia_id,
                    'docente_id' => $horario?->docente_id,
                ];
            }
        }
    }

    /**
     * Livewire action: guarda (o elimina) la celda correspondiente.
     * Llamado desde Alpine.js en la vista.
     */
    public function guardarCelda(string $dia, int $hora, ?int $materia_id, ?int $docente_id): void
    {
        $key = "{$dia}_{$hora}";

        // Si no hay materia ni docente → borrar la celda
        if (! $materia_id || ! $docente_id) {
            Horario::where('curso_id', $this->record)
                ->where('dia_semana', $dia)
                ->where('hora_catedra', $hora)
                ->delete();

            $this->grilla[$key] = [
                'horario_id' => null,
                'materia_id' => null,
                'docente_id' => null,
            ];

            Notification::make()
                ->title('Celda eliminada')
                ->body("Se eliminó el horario de {$dia} {$hora}ra hora.")
                ->warning()
                ->send();

            return;
        }

        $horario = Horario::updateOrCreate(
            [
                'curso_id'    => $this->record,
                'dia_semana'  => $dia,
                'hora_catedra' => $hora,
            ],
            [
                'materia_id' => $materia_id,
                'docente_id' => $docente_id,
            ]
        );

        $this->grilla[$key] = [
            'horario_id' => $horario->id,
            'materia_id' => $horario->materia_id,
            'docente_id' => $horario->docente_id,
        ];

        Notification::make()
            ->title('Horario guardado')
            ->body(
                Materia::find($materia_id)?->nombre . ' – ' .
                Docente::find($docente_id)?->nombre_completo
            )
            ->success()
            ->send();
    }

    // ─── Acciones del encabezado de página ───────────────────────────────────

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportar_pdf')
                ->label('Exportar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->url(fn() => route('horarios.pdf', $this->record))
                ->openUrlInNewTab(),

            Action::make('volver')
                ->label('Volver a Cursos')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(CursoResource::getUrl('index')),
        ];
    }

}
