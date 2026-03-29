<?php

namespace App\Filament\Resources\Cursos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CursoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('planDeEstudio.nombre')->label('Plan de estudio'),
                TextEntry::make('anio')->label('Año'),
                TextEntry::make('division')->label('División'),
                TextEntry::make('ciclo_lectivo')->label('Ciclo lectivo'),
                TextEntry::make('cupo_maximo')->label('Cupo máximo'),
                TextEntry::make('alumnos_activos_count')->label('Alumnos inscriptos'),
            ]);
    }
}
