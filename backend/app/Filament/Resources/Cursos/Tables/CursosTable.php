<?php

namespace App\Filament\Resources\Cursos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CursosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('anio')->label('Año')->sortable(),
                TextColumn::make('division')->label('División')->sortable(),
                TextColumn::make('ciclo_lectivo')->label('Ciclo lectivo')->sortable(),
                TextColumn::make('planDeEstudio.nombre')->label('Plan de estudio')->searchable(),
                TextColumn::make('cupo_maximo')->label('Cupo')->sortable(),
                TextColumn::make('alumnos_activos_count')
                    ->label('Inscriptos')
                    ->getStateUsing(fn ($record) => $record->alumnos_activos_count),
            ])
            ->filters([
                SelectFilter::make('anio')
                    ->options([1=>'1°',2=>'2°',3=>'3°',4=>'4°',5=>'5°',6=>'6°'])
                    ->label('Año'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('ciclo_lectivo', 'desc');
    }
}
