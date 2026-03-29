<?php

namespace App\Filament\Resources\Tutores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TutorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')->required()->maxLength(100),
                TextInput::make('apellido')->required()->maxLength(100),
                TextInput::make('dni')->required()->unique(ignoreRecord: true)->maxLength(15),
                TextInput::make('cuil')->unique(ignoreRecord: true)->maxLength(20),
                Select::make('parentesco')
                    ->options([
                        'padre'   => 'Padre',
                        'madre'   => 'Madre',
                        'tutor'   => 'Tutor legal',
                        'abuelo'  => 'Abuelo/a',
                        'hermano' => 'Hermano/a',
                        'otro'    => 'Otro',
                    ])
                    ->required(),
                TextInput::make('telefono')->tel()->maxLength(20),
                TextInput::make('email')->email()->maxLength(150),
                TextInput::make('domicilio')->maxLength(255),
            ]);
    }
}
