<?php

namespace App\Filament\Resources\Alumnos\Pages;

use App\Filament\Resources\Alumnos\AlumnoResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAlumno extends EditRecord
{
    protected static string $resource = AlumnoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('pdf')
                ->label('Descargar PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->url(fn () => route('alumnos.pdf', $this->record))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
