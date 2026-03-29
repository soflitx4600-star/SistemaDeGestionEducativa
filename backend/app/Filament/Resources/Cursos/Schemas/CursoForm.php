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
                    ->relationship('planDeEstudio', 'nombre')
                    ->searchable()
                    ->required()
                    ->label('Plan de estudio'),
                Select::make('anio')
                    ->options([1=>'1°',2=>'2°',3=>'3°',4=>'4°',5=>'5°',6=>'6°'])
                    ->required()
                    ->label('Año'),
                Select::make('division')
                    ->options(['A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'])
                    ->required()
                    ->label('División'),
                TextInput::make('ciclo_lectivo')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(2100)
                    ->label('Ciclo lectivo'),
                TextInput::make('cupo_maximo')
                    ->numeric()
                    ->default(30)
                    ->label('Cupo máximo'),
            ]);
    }
}
