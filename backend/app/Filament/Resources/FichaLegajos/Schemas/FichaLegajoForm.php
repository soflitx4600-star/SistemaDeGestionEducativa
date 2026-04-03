<?php

namespace App\Filament\Resources\FichaLegajos\Schemas;

use App\Enums\EstadoDocumento;
use App\Enums\TipoDocumento;
use App\Models\Alumno;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class FichaLegajoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos del Legajo')
                    ->schema([
                        Select::make('alumno_id')
                            ->label('Alumno')
                            ->options(fn () => Alumno::orderBy('apellido')->get()->pluck('nombre_completo', 'id'))
                            ->searchable()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),
                        TextInput::make('numero_legajo')
                            ->label('N° Legajo')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(30),
                        DatePicker::make('fecha_apertura')
                            ->label('Fecha de apertura')
                            ->required(),
                        Textarea::make('observaciones')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Documentos')
                    ->schema([
                        Repeater::make('documentos')
                            ->relationship()
                            ->label('')
                            ->schema([
                                Select::make('tipo_documento')
                                    ->label('Tipo de documento')
                                    ->options(
                                        collect(TipoDocumento::cases())
                                            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                                    )
                                    ->required()
                                    ->live(),
                                Select::make('estado')
                                    ->options(
                                        collect(EstadoDocumento::cases())
                                            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                                    )
                                    ->default('pendiente')
                                    ->required(),
                                FileUpload::make('archivo_path')
                                    ->label('Archivo (PDF o imagen)')
                                    ->disk('public')
                                    ->directory('legajos/documentos')
                                    ->visibility('public')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                                    ->maxSize(5120)
                                    ->columnSpanFull(),
                                DatePicker::make('fecha_vencimiento')
                                    ->label('Fecha de vencimiento')
                                    ->visible(
                                        fn (Get $get) =>
                                            TipoDocumento::tryFrom($get('tipo_documento'))?->tieneVencimiento()
                                    ),
                            ])
                            ->columns(2)
                            ->addActionLabel('Agregar documento')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
