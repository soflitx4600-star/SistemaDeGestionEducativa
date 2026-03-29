<?php

namespace App\Filament\Resources\ConfiguracionSistemas\Pages;

use App\Filament\Resources\ConfiguracionSistemas\ConfiguracionSistemaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConfiguracionSistema extends EditRecord
{
    protected static string $resource = ConfiguracionSistemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
