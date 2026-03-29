<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Barryvdh\DomPDF\Facade\Pdf;

class AlumnoPdfController extends Controller
{
    public function descargar(Alumno $alumno)
    {
        $alumno->load(['fichaLegajo', 'tutores', 'historialAcademico.materia']);

        $pdf = Pdf::loadView('pdf.alumno', compact('alumno'))
            ->setPaper('a4', 'portrait');

        $nombre = "alumno_{$alumno->dni}_{$alumno->apellido}.pdf";

        return $pdf->download($nombre);
    }
}
