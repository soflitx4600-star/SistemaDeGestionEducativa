<?php

namespace App\Filament\Resources\PlanesDeEstudio\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PlanDeEstudioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('descripcion')->placeholder('-'),
                TextEntry::make('resolucion_numero')->label('N° Resolución')->placeholder('-'),
                TextEntry::make('ciclo_lectivo_vigencia')->label('Vigencia desde')->placeholder('-'),
                IconEntry::make('is_active')->label('Activo')->boolean(),
            ]);
    }
}
