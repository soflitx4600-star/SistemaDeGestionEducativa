<?php

namespace App\Filament\Resources\PlanesDeEstudio\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlanDeEstudioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(150),
                Textarea::make('descripcion')
                    ->rows(3),
                TextInput::make('resolucion_numero')
                    ->label('N° Resolución')
                    ->maxLength(50),
                TextInput::make('ciclo_lectivo_vigencia')
                    ->label('Vigencia desde')
                    ->numeric()
                    ->minValue(2000),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}
