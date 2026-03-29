<?php

namespace App\Filament\Resources\PlanDeEstudios\Schemas;

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
                    ->required(),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                TextInput::make('resolucion_numero'),
                TextInput::make('ciclo_lectivo_vigencia')
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
