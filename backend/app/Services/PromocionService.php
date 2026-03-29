<?php

namespace App\Services;

use App\Enums\EstadoHistorial;
use App\Models\Alumno;
use App\Models\ConfiguracionSistema;
use App\Models\HistorialAcademico;

class PromocionService
{
    /**
     * Verifica si un alumno puede ser promovido al año siguiente.
     *
     * Cuenta las materias con estado "previa" correspondientes al año de cursado
     * actual y lo compara contra el límite configurable desde el panel.
     */
    public function puedePromocionar(Alumno $alumno, int $anioCursadoActual): bool
    {
        $maxPrevias = (int) ConfiguracionSistema::obtener('max_previas_permitidas', 2);

        $cantidadPrevias = $this->contarPrevias($alumno, $anioCursadoActual);

        return $cantidadPrevias <= $maxPrevias;
    }

    /**
     * Retorna la cantidad actual de previas del alumno para un año de cursado específico.
     */
    public function contarPrevias(Alumno $alumno, int $anioCursadoActual): int
    {
        return HistorialAcademico::where('alumno_id', $alumno->id)
            ->previas()
            ->delAnio($anioCursadoActual)
            ->count();
    }

    /**
     * Retorna las previas pendientes del alumno con el detalle de cada materia.
     *
     * Si se pasa $anioCursadoActual, filtra solo las previas de ese año.
     */
    public function obtenerPrevias(Alumno $alumno, ?int $anioCursadoActual = null)
    {
        $query = HistorialAcademico::where('alumno_id', $alumno->id)
            ->previas()
            ->with('materia');

        if ($anioCursadoActual !== null) {
            $query->delAnio($anioCursadoActual);
        }

        return $query->get();
    }

    /**
     * Retorna un resumen del estado de promoción del alumno para un año dado.
     *
     * @return array{puede_promocionar: bool, previas_actuales: int, max_permitidas: int, detalle: \Illuminate\Database\Eloquent\Collection}
     */
    public function resumenPromocion(Alumno $alumno, int $anioCursadoActual): array
    {
        $maxPrevias     = (int) ConfiguracionSistema::obtener('max_previas_permitidas', 2);
        $previas        = $this->obtenerPrevias($alumno, $anioCursadoActual);

        return [
            'puede_promocionar' => $previas->count() <= $maxPrevias,
            'previas_actuales'  => $previas->count(),
            'max_permitidas'    => $maxPrevias,
            'detalle'           => $previas,
        ];
    }
}


class PromocionService
{
    /**
     * Verifica si un alumno puede ser promovido al año siguiente.
     *
     * Cuenta las materias con estado "previa" que corresponden al año de cursado
     * actual del alumno y lo compara contra el límite configurable.
     *
     * @param  Alumno  $alumno
     * @param  int     $anioCursadoActual  Año del plan de estudios (1-6)
     * @return bool
     */
    public function puedePromocionar(Alumno $alumno, int $anioCursadoActual): bool
    {
        $maxPrevias = (int) ConfiguracionSistema::obtener('max_previas_permitidas', 2);

        $cantidadPrevias = HistorialAcademico::where('alumno_id', $alumno->id)
            ->previas()
            ->delAnio($anioCursadoActual)
            ->count();

        return $cantidadPrevias <= $maxPrevias;
    }

    /**
     * Retorna la cantidad actual de previas del alumno para un año de cursado.
     */
    public function contarPrevias(Alumno $alumno, int $anioCursadoActual): int
    {
        return HistorialAcademico::where('alumno_id', $alumno->id)
            ->previas()
            ->delAnio($anioCursadoActual)
            ->count();
    }

    /**
     * Procesa la promoción de un alumno de forma individual.
     *
     * Si puede promocionar:
     *   - Marca la inscripción actual como 'promovido'.
     *   - Crea una nueva inscripción en el curso del año siguiente.
     *
     * Si no puede:
     *   - Marca la inscripción actual como 'repitiente'.
     *
     * @param  Inscripcion  $inscripcion  La inscripción activa del ciclo actual
     * @param  Curso        $cursoSiguiente  Curso del año siguiente (mismo ciclo_lectivo+1)
     * @return bool  true si fue promovido, false si repite
     */
    public function procesarPromocion(Inscripcion $inscripcion, Curso $cursoSiguiente): bool
    {
        $alumno = $inscripcion->alumno;
        $anioCursadoActual = $inscripcion->curso->anio;

        if ($this->puedePromocionar($alumno, $anioCursadoActual)) {
            $inscripcion->update(['estado' => 'promovido']);

            Inscripcion::create([
                'alumno_id'        => $alumno->id,
                'curso_id'         => $cursoSiguiente->id,
                'ciclo_lectivo'    => $cursoSiguiente->ciclo_lectivo,
                'estado'           => 'activo',
                'fecha_inscripcion' => now()->toDateString(),
            ]);

            return true;
        }

        $inscripcion->update(['estado' => 'repitiente']);

        return false;
    }

    /**
     * Retorna las previas pendientes del alumno con detalle de la materia.
     */
    public function obtenerPrevias(Alumno $alumno, ?int $anioCursadoActual = null)
    {
        $query = HistorialAcademico::where('alumno_id', $alumno->id)
            ->previas()
            ->with('materia');

        if ($anioCursadoActual !== null) {
            $query->delAnio($anioCursadoActual);
        }

        return $query->get();
    }
}
