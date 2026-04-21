<?php

namespace App\Enums;

enum EstadoAlumno: string
{
    case Preinscripto = 'preinscripto';
    case Sorteado     = 'sorteado';
    case Inscripto    = 'inscripto';
    case Regular      = 'regular';
    case Egresado     = 'egresado';
    case Abandono     = 'abandono';
    case Suspendido   = 'suspendido';

    public function label(): string
    {
        return match($this) {
            self::Preinscripto => 'Preinscripto',
            self::Sorteado     => 'Sorteado',
            self::Inscripto    => 'Inscripto',
            self::Regular      => 'Regular',
            self::Egresado     => 'Egresado',
            self::Abandono     => 'Abandono',
            self::Suspendido   => 'Suspendido',
        };
    }
}
