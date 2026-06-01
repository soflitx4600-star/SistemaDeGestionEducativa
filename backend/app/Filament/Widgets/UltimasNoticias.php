<?php

namespace App\Filament\Widgets;

use App\Models\Noticia;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UltimasNoticias extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Últimas Noticias';
    protected int|string|array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Noticia::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('titulo')
                    ->limit(40)
                    ->searchable(),
                TextColumn::make('categoria.nombre')
                    ->label('Categoría')
                    ->badge()
                    ->color('info'),
                IconColumn::make('activa')
                    ->label('Activa')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
