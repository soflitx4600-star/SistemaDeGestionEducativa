<?php

namespace App\Filament\Resources\PlanesDeEstudio\Pages;

use App\Filament\Resources\PlanesDeEstudio\PlanDeEstudioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlanesDeEstudio extends ListRecords
{
    protected static string $resource = PlanDeEstudioResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
