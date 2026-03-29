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
                    ->relationship('planDeEstudio', 'nombre')
                    ->searchable()
                    ->required()
                    ->label('Plan de estudio'),
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(150),
                Select::make('ciclo')
                    ->options(['comun' => 'Ciclo Básico', 'orientado' => 'Ciclo Orientado'])
                    ->required()
                    ->default('comun'),
                Select::make('anio_cursado')
                    ->options([1=>'1°',2=>'2°',3=>'3°',4=>'4°',5=>'5°',6=>'6°'])
                    ->required()
                    ->label('Año de cursado'),
                TextInput::make('horas_semanales')
                    ->numeric()
                    ->minValue(1)
                    ->label('Horas semanales'),
            ]);
    }
}
