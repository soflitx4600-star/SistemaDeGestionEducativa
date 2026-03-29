<?php

namespace App\Filament\Resources\PlanDeEstudios\Pages;

use App\Filament\Resources\PlanDeEstudios\PlanDeEstudioResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPlanDeEstudio extends EditRecord
{
    protected static string $resource = PlanDeEstudioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
