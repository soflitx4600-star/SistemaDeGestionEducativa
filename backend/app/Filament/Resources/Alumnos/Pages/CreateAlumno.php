<?php

namespace App\Filament\Resources\Alumnos\Pages;

use App\Enums\EstadoDocumento;
use App\Enums\TipoDocumento;
use App\Filament\Resources\Alumnos\AlumnoResource;
use App\Filament\Resources\Alumnos\Schemas\AlumnoForm;
use App\Models\DocumentoLegajo;
use App\Models\FichaLegajo;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateAlumno extends CreateRecord
{
    use HasWizard;

    protected static string $resource = AlumnoResource::class;

    public function getSteps(): array
    {
        return AlumnoForm::getSteps();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->cudArchivo = $data['cud_archivo'] ?? null;
        unset($data['cud_archivo']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $alumno = $this->record;

        $ficha = FichaLegajo::create([
            'alumno_id'      => $alumno->id,
            'numero_legajo'  => 'LEG-' . str_pad($alumno->id, 5, '0', STR_PAD_LEFT),
            'fecha_apertura' => now(),
        ]);

        if ($alumno->tiene_cud) {
            DocumentoLegajo::create([
                'ficha_legajo_id' => $ficha->id,
                'tipo_documento'  => TipoDocumento::Cud->value,
                'archivo_path'    => $this->cudArchivo ?? null,
                'estado'          => $this->cudArchivo
                    ? EstadoDocumento::Adjunto->value
                    : EstadoDocumento::Pendiente->value,
            ]);
        }
    }
}
