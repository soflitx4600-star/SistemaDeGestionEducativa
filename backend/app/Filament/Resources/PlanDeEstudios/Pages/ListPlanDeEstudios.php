<?php

namespace App\Filament\Resources\PlanDeEstudios\Pages;

use App\Filament\Resources\PlanDeEstudios\PlanDeEstudioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlanDeEstudios extends ListRecords
{
    protected static string $resource = PlanDeEstudioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
