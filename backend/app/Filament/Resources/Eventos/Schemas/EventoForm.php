<?php

namespace App\Filament\Resources\Eventos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EventoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('titulo')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('descripcion')
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),
                RichEditor::make('contenido')
                    ->columnSpanFull(),
                TextInput::make('lugar')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('fecha_evento')
                    ->label('Fecha del Evento')
                    ->required(),
                Select::make('color')
                    ->label('Color')
                    ->options([
                        'bg-[#002045]' => 'Azul Oscuro',
                        'bg-[#1a365d]' => 'Azul',
                        'bg-[#fed65b]' => 'Amarillo',
                        'bg-[#003f25]' => 'Verde',
                        'bg-[#735c00]' => 'Marrón',
                    ])
                    ->default('bg-[#002045]'),
                Select::make('text_color')
                    ->label('Color de Texto')
                    ->options([
                        'text-white' => 'Blanco',
                        'text-[#002045]' => 'Azul Oscuro',
                    ])
                    ->default('text-white'),
                SpatieMediaLibraryFileUpload::make('imagen')
                    ->collection('imagen')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
                Toggle::make('destacado')
                    ->label('Destacado')
                    ->default(false),
                Toggle::make('activa')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}