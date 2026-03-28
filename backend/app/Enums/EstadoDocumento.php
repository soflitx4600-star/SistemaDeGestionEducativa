<?php

namespace App\Enums;

enum EstadoDocumento: string
{
    case Pendiente = 'pendiente';
    case Adjunto   = 'adjunto';
    case Validado  = 'validado';
    case Rechazado = 'rechazado';

    public function label(): string
    {
        return match($this) {
            self::Pendiente => 'Pendiente',
            self::Adjunto   => 'Adjunto (sin validar)',
            self::Validado  => 'Validado',
            self::Rechazado => 'Rechazado',
        };
    }

    public function estaCompleto(): bool
    {
        return $this === self::Validado;
    }
}
