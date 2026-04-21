<?php

namespace App\Models;

use App\Enums\EstadoAlumno;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Alumno extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'cuil',
        'fecha_nacimiento',
        'genero',
        'domicilio',
        'telefono',
        'email',
        'foto',
        'estado',
        'tiene_cud',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'estado'           => EstadoAlumno::class,
            'tiene_cud'        => 'boolean',
        ];
    }

    public function fichaLegajo(): HasOne
    {
        return $this->hasOne(FichaLegajo::class);
    }

    public function tutores(): BelongsToMany
    {
        return $this->belongsToMany(Tutor::class, 'alumno_tutor')
            ->withPivot('es_responsable_principal')
            ->withTimestamps();
    }

    public function historialAcademico(): HasMany
    {
        return $this->hasMany(HistorialAcademico::class);
    }

    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->apellido}, {$this->nombre}";
    }
}
