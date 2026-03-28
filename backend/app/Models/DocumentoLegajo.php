<?php

namespace App\Models;

use App\Enums\EstadoDocumento;
use App\Enums\TipoDocumento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentoLegajo extends Model
{
    protected $fillable = [
        'ficha_legajo_id',
        'tipo_documento',
        'archivo_path',
        'estado',
        'fecha_vencimiento',
        'validado_por',
        'validado_at',
    ];

    protected function casts(): array
    {
        return [
            'tipo_documento'   => TipoDocumento::class,
            'estado'           => EstadoDocumento::class,
            'fecha_vencimiento' => 'date',
            'validado_at'      => 'datetime',
        ];
    }

    public function fichaLegajo(): BelongsTo
    {
        return $this->belongsTo(FichaLegajo::class);
    }

    public function validador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validado_por');
    }

    public function estaVencido(): bool
    {
        if (! $this->fecha_vencimiento) {
            return false;
        }

        return $this->fecha_vencimiento->isPast();
    }
}
