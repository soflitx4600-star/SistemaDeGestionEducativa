<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horario extends Model
{
    protected $fillable = [
        'curso_id',
        'materia_id',
        'docente_id',
        'dia_semana',
        'hora_catedra',
    ];

    protected function casts(): array
    {
        return [
            'hora_catedra' => 'integer',
        ];
    }

    /**
     * Bloques horarios del turno Tarde del Colegio N°59.
     * Cada hora cátedra dura 40 minutos.
     */
    public static array $bloques = [
        1 => '13:30 - 14:10',
        2 => '14:10 - 14:50',
        3 => '14:50 - 15:30',
        4 => '15:30 - 16:10',
        5 => '16:10 - 16:50',
        6 => '16:50 - 17:30',
        7 => '17:30 - 18:10',
    ];

    /**
     * Etiquetas de hora cátedra (1ra a 7ma).
     */
    public static array $etiquetasHora = [
        1 => '1ra', 2 => '2da', 3 => '3ra', 4 => '4ta',
        5 => '5ta', 6 => '6ta', 7 => '7ma',
    ];

    public static array $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

    // ─── Relaciones ──────────────────────────────────────────────────────────

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class);
    }

    // ─── Accesor: etiqueta de hora (ej. "2da") ───────────────────────────────
    public function getEtiquetaHoraAttribute(): string
    {
        return self::$etiquetasHora[$this->hora_catedra] ?? "{$this->hora_catedra}ra";
    }

    // ─── Accesor: horario como rango (ej. "14:10 - 14:50") ──────────────────
    public function getBloqueAttribute(): string
    {
        return self::$bloques[$this->hora_catedra] ?? '';
    }

    // ─── Scope: filtrar por día ──────────────────────────────────────────────
    public function scopeDia($query, string $dia)
    {
        return $query->where('dia_semana', $dia);
    }
}
