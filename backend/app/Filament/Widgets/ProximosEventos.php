<?php

namespace App\Filament\Widgets;

use App\Models\Evento;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProximosEventos extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Próximos Eventos';
    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Evento::query()
                    ->where('fecha_evento', '>=', now()->toDateString())
                    ->orderBy('fecha_evento', 'asc')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('fecha_evento')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable()
                    ->badge()
                    ->color('warning'),
                TextColumn::make('titulo')
                    ->limit(30),
                TextColumn::make('lugar')
                    ->limit(20)
                    ->placeholder('—'),
                IconColumn::make('destacado')
                    ->boolean(),
            ])
            ->paginated(false);
    }
}
