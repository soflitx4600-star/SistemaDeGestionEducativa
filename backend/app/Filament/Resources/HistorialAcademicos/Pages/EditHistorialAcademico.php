<?php

namespace App\Filament\Resources\HistorialAcademicos\Pages;

use App\Filament\Resources\HistorialAcademicos\HistorialAcademicoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHistorialAcademico extends EditRecord
{
    protected static string $resource = HistorialAcademicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
