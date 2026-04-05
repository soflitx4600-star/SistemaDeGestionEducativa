<?php

namespace App\Filament\Resources\FichaLegajos\Pages;

use App\Filament\Resources\FichaLegajos\FichaLegajoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFichaLegajos extends ListRecords
{
    protected static string $resource = FichaLegajoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
