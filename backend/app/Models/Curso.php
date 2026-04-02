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
        'turno',
        'preceptor',
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

    // ─── Relaciones ──────────────────────────────────────────────────────────

    public function planDeEstudio(): BelongsTo
    {
        return $this->belongsTo(PlanDeEstudio::class);
    }

    public function historialAcademico(): HasMany
    {
        return $this->hasMany(HistorialAcademico::class);
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class);
    }

    // ─── Accesor: total de alumnos únicos inscriptos en este curso ───────────
    // Usa HistorialAcademico para contar alumnos distintos por curso_id.
    // Si en el futuro se agrega curso_id directo en alumnos, cambiar aquí.
    public function getAlumnosCountAttribute(): int
    {
        return $this->historialAcademico()
            ->distinct('alumno_id')
            ->count('alumno_id');
    }

    // ─── Accesor: título legible del curso ───────────────────────────────────
    public function getTituloAttribute(): string
    {
        return "{$this->anio}° {$this->division} — Turno {$this->turno} ({$this->ciclo_lectivo})";
    }

    // ─── Scope: filtrar por turno ─────────────────────────────────────────────
    public function scopeTurno($query, string $turno)
    {
        return $query->where('turno', $turno);
    }

    // ─── Scope: filtrar por ciclo lectivo ────────────────────────────────────
    public function scopeCicloLectivo($query, int $ciclo)
    {
        return $query->where('ciclo_lectivo', $ciclo);
    }
}
