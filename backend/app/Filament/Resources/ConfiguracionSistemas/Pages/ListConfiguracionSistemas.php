<?php

namespace App\Filament\Resources\ConfiguracionSistemas\Pages;

use App\Filament\Resources\ConfiguracionSistemas\ConfiguracionSistemaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConfiguracionSistemas extends ListRecords
{
    protected static string $resource = ConfiguracionSistemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
