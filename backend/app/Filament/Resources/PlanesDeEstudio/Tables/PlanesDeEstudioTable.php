<?php

namespace App\Filament\Resources\PlanesDeEstudio\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlanesDeEstudioTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->searchable()->sortable(),
                TextColumn::make('resolucion_numero')->label('Resolución')->searchable(),
                TextColumn::make('ciclo_lectivo_vigencia')->label('Vigencia')->sortable(),
                IconColumn::make('is_active')->label('Activo')->boolean(),
                TextColumn::make('materias_count')->label('Materias')->counts('materias')->sortable(),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
