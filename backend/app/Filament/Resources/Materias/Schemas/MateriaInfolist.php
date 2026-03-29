<?php

namespace App\Filament\Resources\Materias\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MateriaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('planDeEstudio.nombre')->label('Plan de estudio'),
                TextEntry::make('ciclo')->formatStateUsing(fn ($state) => $state === 'comun' ? 'Ciclo Básico' : 'Ciclo Orientado'),
                TextEntry::make('anio_cursado')->label('Año de cursado'),
                TextEntry::make('horas_semanales')->label('Horas semanales')->placeholder('-'),
            ]);
    }
}
