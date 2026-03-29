<?php

namespace App\Filament\Resources\PlanesDeEstudio\Pages;

use App\Filament\Resources\PlanesDeEstudio\PlanDeEstudioResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPlanDeEstudio extends ViewRecord
{
    protected static string $resource = PlanDeEstudioResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
