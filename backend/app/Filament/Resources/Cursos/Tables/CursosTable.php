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
                TextColumn::make('anio')
                    ->label('Año')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('division')
                    ->label('División')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('turno')
                    ->label('Turno')
                    ->badge()
                    ->color(fn(string $state) => $state === 'Mañana' ? 'warning' : 'info'),

                TextColumn::make('preceptor')
                    ->label('Preceptor/a')
                    ->searchable()
                    ->default('—')
                    ->icon('heroicon-o-user'),

                TextColumn::make('ciclo_lectivo')
                    ->label('Ciclo Lectivo')
                    ->sortable(),

                // Columna de alumnos: usa el accesor getAlumnosCountAttribute()
                // del modelo Curso, que cuenta alumnos únicos vía HistorialAcademico.
                TextColumn::make('alumnos_count')
                    ->label('Alumnos')
                    ->getStateUsing(fn($record) => $record->alumnos_count)
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-user-group')
                    ->tooltip('Total de alumnos únicos inscriptos en este curso'),

                TextColumn::make('cupo_maximo')
                    ->label('Cupo')
                    ->numeric()
                    ->sortable()
                    ->color(fn($record) => $record->alumnos_count >= $record->cupo_maximo ? 'danger' : 'gray'),
            ])
            ->filters([
                SelectFilter::make('turno')
                    ->label('Turno')
                    ->options(['Mañana' => 'Mañana', 'Tarde' => 'Tarde']),

                SelectFilter::make('ciclo_lectivo')
                    ->label('Ciclo Lectivo')
                    ->options(
                        fn() => \App\Models\Curso::query()
                            ->orderByDesc('ciclo_lectivo')
                            ->pluck('ciclo_lectivo', 'ciclo_lectivo')
                            ->toArray()
                    ),

                SelectFilter::make('anio')
                    ->label('Año')
                    ->options([
                        1 => '1°', 2 => '2°', 3 => '3°',
                        4 => '4°', 5 => '5°', 6 => '6°',
                    ]),
            ])
            ->defaultSort('anio')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                \Filament\Actions\Action::make('horario')
                    ->label('Horario')
                    ->icon('heroicon-o-calendar-days')
                    ->color('info')
                    ->url(fn($record) => \App\Filament\Resources\Cursos\CursoResource::getUrl('grilla-horario', ['record' => $record])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
