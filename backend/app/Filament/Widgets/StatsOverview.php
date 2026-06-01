<?php

namespace App\Filament\Widgets;

use App\Models\Alumno;
use App\Models\Consulta;
use App\Models\Docente;
use App\Models\Evento;
use App\Models\Noticia;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Alumnos', Alumno::count())
                ->description('Total registrados')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info')
                ->chart([Alumno::count()]),

            Stat::make('Docentes', Docente::count())
                ->description('Personal docente')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Noticias activas', Noticia::where('activa', true)->count())
                ->description('Publicadas en el sitio')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning'),

            Stat::make('Consultas pendientes', Consulta::where('estado', 'pendiente')->count())
                ->description('Sin responder')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
