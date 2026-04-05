<?php

namespace App\Filament\Imports;

use App\Models\Alumno;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class AlumnoImporter extends Importer
{
    protected static ?string $model = Alumno::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('user')
                ->relationship(),
            ImportColumn::make('nombre')
                ->requiredMapping()
                ->rules(['required', 'max:100']),
            ImportColumn::make('apellido')
                ->requiredMapping()
                ->rules(['required', 'max:100']),
            ImportColumn::make('dni')
                ->requiredMapping()
                ->rules(['required', 'max:15']),
            ImportColumn::make('cuil')
                ->rules(['max:20']),
            ImportColumn::make('fecha_nacimiento')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('genero')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('domicilio')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('telefono')
                ->rules(['max:20']),
            ImportColumn::make('email')
                ->rules(['email', 'max:150']),
            ImportColumn::make('foto')
                ->rules(['max:255']),
            ImportColumn::make('estado')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): Alumno
    {
        return new Alumno();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your alumno import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
