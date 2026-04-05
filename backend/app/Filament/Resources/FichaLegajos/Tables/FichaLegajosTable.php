<?php

namespace App\Filament\Resources\FichaLegajos\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FichaLegajosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('numero_legajo')
                    ->label('N° Legajo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('alumno.nombre_completo')
                    ->label('Alumno')
                    ->searchable(['nombre', 'apellido'])
                    ->sortable(),
                TextColumn::make('fecha_apertura')
                    ->label('Apertura')
                    ->date()
                    ->sortable(),
                TextColumn::make('documentos_count')
                    ->label('Documentos')
                    ->counts('documentos')
                    ->badge()
                    ->color('info'),
                TextColumn::make('legajo_completo')
                    ->label('Legajo completo')
                    ->getStateUsing(fn ($record) => $record->legajo_completo ? 'Completo' : 'Incompleto')
                    ->badge()
                    ->color(fn ($state) => $state === 'Completo' ? 'success' : 'warning'),
            ])
            ->defaultSort('fecha_apertura', 'desc');
    }
}
