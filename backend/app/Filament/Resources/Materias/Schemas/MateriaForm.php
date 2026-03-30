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
                Select::make('ciclo')
                    ->options([
                        'comun' => 'Ciclo Básico',
                        'orientado' => 'Ciclo Orientado',
                    ])
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
