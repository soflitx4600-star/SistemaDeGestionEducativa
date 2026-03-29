<?php

namespace App\Filament\Resources\Materias\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MateriasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->searchable()->sortable(),
                TextColumn::make('anio_cursado')->label('Año')->sortable(),
                TextColumn::make('ciclo')
                    ->label('Ciclo')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'comun' ? 'Básico' : 'Orientado')
                    ->sortable(),
                TextColumn::make('horas_semanales')->label('Hs/sem')->sortable(),
                TextColumn::make('planDeEstudio.nombre')->label('Plan')->searchable()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('anio_cursado')
                    ->options([1=>'1°',2=>'2°',3=>'3°',4=>'4°',5=>'5°',6=>'6°'])
                    ->label('Año'),
                SelectFilter::make('ciclo')
                    ->options(['comun'=>'Ciclo Básico','orientado'=>'Ciclo Orientado']),
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
            ->defaultSort('anio_cursado');
    }
}
