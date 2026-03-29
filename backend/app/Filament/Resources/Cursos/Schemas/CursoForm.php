<?php

namespace App\Filament\Resources\Cursos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CursoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('plan_de_estudio_id')
                    ->relationship('planDeEstudio', 'id')
                    ->required(),
                TextInput::make('anio')
                    ->required()
                    ->numeric(),
                TextInput::make('division')
                    ->required(),
                TextInput::make('ciclo_lectivo')
                    ->required()
                    ->numeric(),
                TextInput::make('cupo_maximo')
                    ->required()
                    ->numeric()
                    ->default(30),
            ]);
    }
}
