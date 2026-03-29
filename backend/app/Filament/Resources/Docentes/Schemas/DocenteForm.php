<?php

namespace App\Filament\Resources\Docentes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocenteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Foto del docente')
                    ->schema([
                        FileUpload::make('foto')
                            ->label('Foto')
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->disk('public')
                            ->directory('fotos/docentes')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ]),

                Section::make('Datos personales')
                    ->schema([
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
                            ->maxLength(150)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Acceso al sistema')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->label('Usuario del sistema'),
                    ]),
            ]);
    }
}
