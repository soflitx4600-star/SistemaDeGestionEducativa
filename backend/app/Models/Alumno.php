<?php

namespace App\Models;

use App\Enums\EstadoAlumno;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Alumno extends Model
{
    protected $fillable = [
        'user_id',
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
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'estado'           => EstadoAlumno::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->apellido}, {$this->nombre}";
    }

    // ¡ESTA ES LA RELACIÓN QUE FALTABA!
    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class);
    }
}