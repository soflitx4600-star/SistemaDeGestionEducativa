<?php

namespace App\Filament\Resources\Consultas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ConsultasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_completo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('correo_electronico')
                    ->searchable(),
                TextColumn::make('telefono')
                    ->searchable(),
                TextColumn::make('asunto')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'resuelto' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'resuelto' => 'Resuelto',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
