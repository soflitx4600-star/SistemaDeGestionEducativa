<?php

namespace App\Enums;

enum TipoDocumento: string
{
    case DniAlumno               = 'dni_alumno';
    case DniTutor                = 'dni_tutor';
    case CuilAlumno              = 'cuil_alumno';
    case CuilTutor               = 'cuil_tutor';
    case ConstanciaAlumnoRegular = 'constancia_alumno_regular';
    case Certificado7moGrado     = 'certificado_7mo_grado';
    case PartidaNacimiento       = 'partida_nacimiento';
    case TituloPrimaria          = 'titulo_primaria';
    case Cud                     = 'cud';

    public function label(): string
    {
        return match($this) {
            self::DniAlumno               => 'DNI del Alumno',
            self::DniTutor                => 'DNI del Tutor',
            self::CuilAlumno              => 'Constancia de CUIL del Alumno',
            self::CuilTutor               => 'Constancia de CUIL del Tutor',
            self::ConstanciaAlumnoRegular => 'Constancia de Alumno Regular',
            self::Certificado7moGrado     => 'Certificado de 7mo Grado',
            self::PartidaNacimiento       => 'Partida de Nacimiento',
            self::TituloPrimaria          => 'Título Primaria',
            self::Cud                     => 'Certificado Único de Discapacidad (CUD)',
        };
    }

    public function tieneVencimiento(): bool
    {
        return $this === self::ConstanciaAlumnoRegular;
    }

    public static function requeridos(): array
    {
        return self::cases();
    }
}
