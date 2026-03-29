<?php

namespace App\Filament\Resources\Alumnos\Schemas;

use App\Enums\EstadoAlumno;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AlumnoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('apellido')
                    ->required(),
                TextInput::make('dni')
                    ->required(),
                TextInput::make('cuil'),
                DatePicker::make('fecha_nacimiento')
                    ->required(),
                TextInput::make('genero')
                    ->required(),
                TextInput::make('domicilio')
                    ->required(),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Select::make('estado')
                    ->options(EstadoAlumno::class)
                    ->default('preinscripto')
                    ->required(),
            ]);
    }
}
