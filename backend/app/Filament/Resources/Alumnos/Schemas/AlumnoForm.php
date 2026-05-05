<?php

namespace App\Filament\Resources\Alumnos\Schemas;

use App\Enums\EstadoAlumno;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class AlumnoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Foto del alumno')
                    ->schema([
                        FileUpload::make('foto')
                            ->label('Foto')
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->disk('public')
                            ->directory('fotos/alumnos')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ]),

                Section::make('Datos personales')
                    ->schema([
                        TextInput::make('nombre')->required()->maxLength(100),
                        TextInput::make('apellido')->required()->maxLength(100),
                        TextInput::make('dni')->required()->unique(ignoreRecord: true)->maxLength(15),
                        TextInput::make('cuil')->unique(ignoreRecord: true)->maxLength(20),
                        DatePicker::make('fecha_nacimiento')->required()->label('Fecha de nacimiento'),
                        Select::make('genero')
                            ->options(['masculino' => 'Masculino', 'femenino' => 'Femenino', 'otro' => 'Otro'])
                            ->required(),
                        TextInput::make('domicilio')->required()->maxLength(255)->columnSpanFull(),
                        TextInput::make('telefono')->tel()->maxLength(20),
                        TextInput::make('email')->email()->unique(ignoreRecord: true)->maxLength(150),
                    ])
                    ->columns(2),

                Section::make('Estado')
                    ->schema([
                        Select::make('estado')
                            ->options(EstadoAlumno::class)
                            ->default('regular')
                            ->required(),
                        Toggle::make('tiene_cud')
                            ->label('¿El alumno tiene CUD?')
                            ->live()
                            ->columnSpanFull(),
                        FileUpload::make('cud_archivo')
                            ->label('Archivo CUD (PDF o imagen)')
                            ->disk('public')
                            ->directory('legajos/cud')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                            ->maxSize(5120)
                            ->columnSpanFull()
                            ->visible(fn (Get $get) => (bool) $get('tiene_cud')),
                    ]),
            ]);
    }

    public static function getSteps(): array
    {
        return [
            Step::make('Datos Personales')
                ->icon('heroicon-o-user')
                ->schema([
                    FileUpload::make('foto')
                        ->label('Foto del alumno')
                        ->image()
                        ->imageEditor()
                        ->circleCropper()
                        ->disk('public')
                        ->directory('fotos/alumnos')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->columnSpanFull(),
                    TextInput::make('nombre')->required()->maxLength(100),
                    TextInput::make('apellido')->required()->maxLength(100),
                    TextInput::make('dni')->required()->unique(ignoreRecord: true)->maxLength(15),
                    TextInput::make('cuil')->unique(ignoreRecord: true)->maxLength(20),
                    DatePicker::make('fecha_nacimiento')->required()->label('Fecha de nacimiento'),
                    Select::make('genero')
                        ->options(['masculino' => 'Masculino', 'femenino' => 'Femenino', 'otro' => 'Otro'])
                        ->required(),
                    TextInput::make('domicilio')->required()->maxLength(255)->columnSpanFull(),
                    TextInput::make('telefono')->tel()->maxLength(20),
                    TextInput::make('email')->email()->unique(ignoreRecord: true)->maxLength(150),
                ])
                ->columns(2),

            Step::make('Estado')
                ->icon('heroicon-o-check-circle')
                ->schema([
                    Select::make('estado')
                        ->options(EstadoAlumno::class)
                        ->default('regular')
                        ->required(),
                    Toggle::make('tiene_cud')
                        ->label('¿El alumno tiene CUD (Certificado Único de Discapacidad)?')
                        ->live()
                        ->columnSpanFull(),
                    FileUpload::make('cud_archivo')
                        ->label('Archivo CUD (PDF o imagen)')
                        ->disk('public')
                        ->directory('legajos/cud')
                        ->visibility('public')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                        ->maxSize(5120)
                        ->columnSpanFull()
                        ->visible(fn (Get $get) => (bool) $get('tiene_cud')),
                ]),
        ];
    }
}
