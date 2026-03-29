<?php

namespace App\Filament\Resources\Materias\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MateriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('plan_de_estudio_id')
                    ->relationship('planDeEstudio', 'id')
                    ->required(),
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('ciclo')
                    ->required()
                    ->default('comun'),
                TextInput::make('anio_cursado')
                    ->required()
                    ->numeric(),
                TextInput::make('horas_semanales')
                    ->numeric(),
            ]);
    }
}
