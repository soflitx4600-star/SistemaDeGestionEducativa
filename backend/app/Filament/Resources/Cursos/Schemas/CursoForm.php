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
                    ->label('Plan de Estudio')
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('anio')
                    ->label('Año')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(6),

                TextInput::make('division')
                    ->label('División')
                    ->required()
                    ->maxLength(10)
                    ->placeholder('ej: 7ma, 8va, A, B'),

                Select::make('turno')
                    ->label('Turno')
                    ->options(['Mañana' => 'Mañana', 'Tarde' => 'Tarde'])
                    ->required()
                    ->default('Tarde'),

                TextInput::make('preceptor')
                    ->label('Preceptor/a')
                    ->nullable()
                    ->maxLength(100)
                    ->placeholder('Apellido, Nombre'),

                TextInput::make('ciclo_lectivo')
                    ->label('Ciclo Lectivo')
                    ->required()
                    ->numeric()
                    ->minValue(2020)
                    ->maxValue(2099)
                    ->default(now()->year),

                TextInput::make('cupo_maximo')
                    ->label('Cupo Máximo')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(30),
            ]);
    }
}
