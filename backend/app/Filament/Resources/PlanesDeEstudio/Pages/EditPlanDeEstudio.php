<?php

namespace App\Filament\Resources\PlanesDeEstudio\Pages;

use App\Filament\Resources\PlanesDeEstudio\PlanDeEstudioResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPlanDeEstudio extends EditRecord
{
    protected static string $resource = PlanDeEstudioResource::class;

    protected function getHeaderActions(): array
    {
        return [ViewAction::make(), DeleteAction::make()];
    }
}
