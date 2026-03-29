<?php

namespace App\Filament\Resources\HistorialAcademicos\Schemas;

use App\Enums\EstadoHistorial;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HistorialAcademicoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('alumno_id')
                    ->relationship('alumno', 'id')
                    ->required(),
                Select::make('materia_id')
                    ->relationship('materia', 'id')
                    ->required(),
                Select::make('curso_id')
                    ->relationship('curso', 'id')
                    ->required(),
                TextInput::make('ciclo_lectivo')
                    ->required()
                    ->numeric(),
                Select::make('estado')
                    ->options(EstadoHistorial::class)
                    ->default('cursando')
                    ->required(),
                TextInput::make('nota_cursada')
                    ->numeric(),
                TextInput::make('nota_final')
                    ->numeric(),
            ]);
    }
}
