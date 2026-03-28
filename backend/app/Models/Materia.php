<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    protected $fillable = [
        'plan_de_estudio_id',
        'nombre',
        'ciclo',
        'anio_cursado',
        'horas_semanales',
    ];

    protected function casts(): array
    {
        return [
            'anio_cursado'   => 'integer',
            'horas_semanales' => 'integer',
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

    public function scopeDelAnio($query, int $anio)
    {
        return $query->where('anio_cursado', $anio);
    }

    public function scopeCicloComun($query)
    {
        return $query->where('ciclo', 'comun');
    }

    public function scopeCicloOrientado($query)
    {
        return $query->where('ciclo', 'orientado');
    }
}
