<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FichaLegajo extends Model
{
    protected $fillable = [
        'alumno_id',
        'numero_legajo',
        'fecha_apertura',
        'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_apertura' => 'date',
        ];
    }

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class);
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(DocumentoLegajo::class);
    }

    /**
     * Indica si todos los documentos obligatorios están validados.
     */
    public function getLegajoCompletoAttribute(): bool
    {
        return $this->documentos()->where('estado', '!=', 'validado')->doesntExist();
    }
}
