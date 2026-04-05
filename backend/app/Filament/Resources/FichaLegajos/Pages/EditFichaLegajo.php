<?php

namespace App\Filament\Resources\FichaLegajos\Pages;

use App\Filament\Resources\FichaLegajos\FichaLegajoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFichaLegajo extends EditRecord
{
    protected static string $resource = FichaLegajoResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
