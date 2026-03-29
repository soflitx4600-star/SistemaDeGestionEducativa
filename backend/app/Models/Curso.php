<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    protected $fillable = [
        'plan_de_estudio_id',
        'anio',
        'division',
        'ciclo_lectivo',
        'cupo_maximo',
    ];

    protected function casts(): array
    {
        return [
            'anio'        => 'integer',
            'cupo_maximo' => 'integer',
        ];
    }

    public function planDeEstudio(): BelongsTo
    {
        return $this->belongsTo(PlanDeEstudio::class);
    }

    public function historialAcademico(): HasMany
    {
        return $this->hasMany(HistorialAcademico::class);
    }

    public function getAlumnosCountAttribute(): int
    {
        return $this->historialAcademico()->distinct('alumno_id')->count('alumno_id');
    }

    public function getTituloAttribute(): string
    {
        return "{$this->anio}° {$this->division} ({$this->ciclo_lectivo})";
    }
}
