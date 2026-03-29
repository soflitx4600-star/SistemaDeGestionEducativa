<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Barryvdh\DomPDF\Facade\Pdf;

class DocentePdfController extends Controller
{
    public function descargar(Docente $docente)
    {
        $docente->load(['user', 'materias']);

        $pdf = Pdf::loadView('pdf.docente', compact('docente'))
            ->setPaper('a4', 'portrait');

        $nombre = "docente_{$docente->dni}_{$docente->apellido}.pdf";

        return $pdf->download($nombre);
    }
}
