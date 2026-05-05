<?php

namespace App\Enums;

enum EstadoAlumno: string
{
    case Regular    = 'regular';
    case Egresado   = 'egresado';
    case Abandono   = 'abandono';
    case Suspendido = 'suspendido';

    public function label(): string
    {
        return match($this) {
            self::Regular    => 'Regular',
            self::Egresado   => 'Egresado',
            self::Abandono   => 'Abandono',
            self::Suspendido => 'Suspendido',
        };
    }
}
