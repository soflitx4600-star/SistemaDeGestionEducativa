<?php

namespace App\Filament\Resources\Docentes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard\Step;
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
                        TextInput::make('titulo')
                            ->label('Título')
                            ->maxLength(150)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getSteps(): array
    {
        return [
            Step::make('Datos Personales')
                ->icon('heroicon-o-user')
                ->schema([
                    FileUpload::make('foto')
                        ->label('Foto del docente')
                        ->image()
                        ->imageEditor()
                        ->circleCropper()
                        ->disk('public')
                        ->directory('fotos/docentes')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->columnSpanFull(),
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
                    TextInput::make('titulo')
                        ->label('Título')
                        ->maxLength(150)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ];
    }
}
