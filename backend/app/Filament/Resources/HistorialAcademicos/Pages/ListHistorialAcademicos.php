<?php

namespace App\Filament\Resources\HistorialAcademicos\Pages;

use App\Filament\Resources\HistorialAcademicos\HistorialAcademicoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistorialAcademicos extends ListRecords
{
    protected static string $resource = HistorialAcademicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
