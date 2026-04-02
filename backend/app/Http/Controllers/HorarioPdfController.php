<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Horario;
use Barryvdh\DomPDF\Facade\Pdf;

class HorarioPdfController extends Controller
{
    public function descargar(int $curso)
    {
        $curso = Curso::findOrFail($curso);

        $horarios = Horario::with(['materia', 'docente'])
            ->where('curso_id', $curso->id)
            ->get();

        $dias = Horario::$dias;
        $horas = [1, 2, 3, 4, 5, 6, 7];
        $bloques = Horario::$bloques;

        // Construir grilla indexada [dia][hora]
        $grilla = [];
        foreach ($horarios as $h) {
            $grilla[$h->dia_semana][$h->hora_catedra] = [
                'materia' => $h->materia->nombre,
                'docente' => $h->docente->nombre_completo,
            ];
        }

        $pdf = Pdf::loadView('pdf.horario', compact('curso', 'grilla', 'dias', 'horas', 'bloques'))
            ->setPaper('a4', 'landscape');

        $nombre = "Horario_{$curso->anio}_{$curso->division}_{$curso->ciclo_lectivo}.pdf";

        return $pdf->download($nombre);
    }
}
