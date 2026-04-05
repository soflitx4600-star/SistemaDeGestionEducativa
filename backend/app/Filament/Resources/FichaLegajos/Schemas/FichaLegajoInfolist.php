<?php

namespace App\Filament\Resources\FichaLegajos\Schemas;

use App\Enums\TipoDocumento;
use App\Models\DocumentoLegajo;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FichaLegajoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos del Legajo')
                    ->schema([
                        TextEntry::make('numero_legajo')->label('N° Legajo'),
                        TextEntry::make('fecha_apertura')->date()->label('Fecha de apertura'),
                        TextEntry::make('alumno.nombre_completo')->label('Alumno'),
                        TextEntry::make('observaciones')->placeholder('Sin observaciones')->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Documentos del Legajo')
                    ->schema([
                        RepeatableEntry::make('documentos')
                            ->label('')
                            ->schema([
                                TextEntry::make('tipo_documento')
                                    ->label('Documento')
                                    ->formatStateUsing(fn ($state) => $state instanceof TipoDocumento ? $state->label() : $state),
                                TextEntry::make('estado')
                                    ->label('Estado')
                                    ->badge()
                                    ->color(fn ($state) => match ($state?->value ?? $state) {
                                        'validado'  => 'success',
                                        'adjunto'   => 'warning',
                                        'rechazado' => 'danger',
                                        default     => 'gray',
                                    }),
                                TextEntry::make('archivo_path')
                                    ->label('Archivo')
                                    ->formatStateUsing(fn ($state) => $state ? '✔ Archivo cargado' : '✘ Sin archivo')
                                    ->color(fn ($state) => $state ? 'success' : 'danger'),
                                TextEntry::make('fecha_vencimiento')
                                    ->label('Vencimiento')
                                    ->date()
                                    ->placeholder('—'),
                            ])
                            ->columns(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
