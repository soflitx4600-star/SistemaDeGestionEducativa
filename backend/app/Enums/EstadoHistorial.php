<?php

namespace App\Enums;

enum EstadoHistorial: string
{
    case Cursando    = 'cursando';
    case Aprobada    = 'aprobada';
    case Desaprobada = 'desaprobada';
    case Previa      = 'previa';
    case Libre       = 'libre';

    public function label(): string
    {
        return match($this) {
            self::Cursando    => 'Cursando',
            self::Aprobada    => 'Aprobada',
            self::Desaprobada => 'Desaprobada',
            self::Previa      => 'Previa',
            self::Libre       => 'Libre',
        };
    }

    /** Estados que cuentan como "previa" para el límite de promoción */
    public function esPrevia(): bool
    {
        return $this === self::Previa;
    }

    /** Estados terminales (no se pueden modificar salvo corrección manual) */
    public function esTerminal(): bool
    {
        return $this === self::Aprobada;
    }
}
