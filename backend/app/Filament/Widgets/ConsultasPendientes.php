<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ConsultasPendientes extends BaseWidget
{
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Consultas Pendientes';
    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Consulta::query()
                    ->where('estado', 'pendiente')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('nombre_completo')
                    ->label('Nombre')
                    ->limit(25),
                TextColumn::make('asunto')
                    ->limit(25),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'resuelto'  => 'success',
                        default     => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Recibido')
                    ->since(),
            ])
            ->paginated(false);
    }
}
