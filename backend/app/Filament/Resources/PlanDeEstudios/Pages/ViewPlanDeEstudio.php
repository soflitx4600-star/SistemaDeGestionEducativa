<?php

namespace App\Filament\Resources\PlanDeEstudios\Pages;

use App\Filament\Resources\PlanDeEstudios\PlanDeEstudioResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPlanDeEstudio extends ViewRecord
{
    protected static string $resource = PlanDeEstudioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
