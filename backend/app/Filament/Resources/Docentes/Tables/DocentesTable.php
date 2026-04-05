<?php

namespace App\Filament\Resources\Docentes\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocentesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('foto')
                    ->label('')
                    ->collection('docentes')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name='.urlencode($record->nombre).'&background=184158&color=fff')
                    ->size(40),
                TextColumn::make('apellido')->searchable()->sortable(),
                TextColumn::make('nombre')->searchable()->sortable(),
                TextColumn::make('dni')->searchable(),
                TextColumn::make('cuil')->searchable()->toggleable(),
                TextColumn::make('telefono')->searchable()->toggleable(),
                TextColumn::make('email')->searchable()->toggleable(),
                TextColumn::make('especialidad')->searchable()->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
                Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => route('docentes.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('apellido');
    }
}
