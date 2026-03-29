<?php

namespace App\Filament\Resources\Docentes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocenteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->label('Usuario del sistema'),
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(100),
                TextInput::make('apellido')
                    ->required()
                    ->maxLength(100),
                TextInput::make('dni')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(15),
                TextInput::make('cuil')
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),
                TextInput::make('telefono')
                    ->tel()
                    ->maxLength(20),
                TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->maxLength(150),
                TextInput::make('especialidad')
                    ->maxLength(150),
            ]);
    }
}
