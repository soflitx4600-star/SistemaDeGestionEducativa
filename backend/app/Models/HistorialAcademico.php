<?php

namespace App\Models;

use App\Enums\EstadoHistorial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistorialAcademico extends Model
{
    protected $table = 'historial_academico';

    protected $fillable = [
        'alumno_id',
        'materia_id',
        'inscripcion_id',
        'ciclo_lectivo',
        'estado',
        'nota_cursada',
        'nota_final',
    ];

    protected function casts(): array
    {
        return [
            'estado'        => EstadoHistorial::class,
            'ciclo_lectivo' => 'integer',
            'nota_cursada'  => 'decimal:2',
            'nota_final'    => 'decimal:2',
        ];
    }

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class);
    }

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }

    public function inscripcion(): BelongsTo
    {
        return $this->belongsTo(Inscripcion::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePrevias($query)
    {
        return $query->where('estado', EstadoHistorial::Previa->value);
    }

    public function scopeAprobadas($query)
    {
        return $query->where('estado', EstadoHistorial::Aprobada->value);
    }

    public function scopeDelAnio($query, int $anioCursado)
    {
        return $query->whereHas('materia', fn ($q) => $q->where('anio_cursado', $anioCursado));
    }

    public function scopeDelCiclo($query, int $cicloLectivo)
    {
        return $query->where('ciclo_lectivo', $cicloLectivo);
    }
}
