<?php

namespace App\Filament\Resources\FichaLegajos\Pages;

use App\Filament\Resources\FichaLegajos\FichaLegajoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFichaLegajo extends ViewRecord
{
    protected static string $resource = FichaLegajoResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
