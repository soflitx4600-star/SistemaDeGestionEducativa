<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * List all active eventos with pagination.
     */
    public function index(): JsonResponse
    {
        $eventos = Evento::query()
            ->where('activa', true)
            ->orderBy('fecha_evento')
            ->paginate(50);

        $eventos->getCollection()->transform(function (Evento $evento) {
            return $this->formatEvento($evento, withContent: true);
        });

        return response()->json($eventos);
    }

    /**
     * Display a single evento by id.
     */
    public function show(Evento $evento): JsonResponse
    {
        if (!$evento->activa) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        return response()->json($this->formatEvento($evento, withContent: true));
    }

    /**
     * Store a newly created evento in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'contenido' => 'required|string',
            'lugar' => 'required|string|max:255',
            'fecha_evento' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'nullable|string|max:50',
            'text_color' => 'nullable|string|max:50',
            'destacado' => 'boolean',
            'activa' => 'boolean',
        ]);

        $validated['destacado'] = $validated['destacado'] ?? false;
        $validated['activa'] = $validated['activa'] ?? true;
        $validated['color'] = $validated['color'] ?? 'bg-[#002045]';
        $validated['text_color'] = $validated['text_color'] ?? 'text-white';

        $evento = Evento::create($validated);

        if ($request->hasFile('imagen')) {
            $evento->addMediaFromRequest('imagen')
                ->toMediaCollection('imagen');
        }

        return response()->json($this->formatEvento($evento), 201);
    }

    /**
     * Update the specified evento in storage.
     */
    public function update(Request $request, Evento $evento): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string|max:500',
            'contenido' => 'sometimes|string',
            'lugar' => 'sometimes|string|max:255',
            'fecha_evento' => 'sometimes|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'nullable|string|max:50',
            'text_color' => 'nullable|string|max:50',
            'destacado' => 'boolean',
            'activa' => 'boolean',
        ]);

        $evento->update($validated);

        if ($request->hasFile('imagen')) {
            $evento->clearMediaCollection('imagen');
            $evento->addMediaFromRequest('imagen')
                ->toMediaCollection('imagen');
        }

        return response()->json($this->formatEvento($evento));
    }

    /**
     * Remove the specified evento from storage.
     */
    public function destroy(Evento $evento): JsonResponse
    {
        $evento->delete();

        return response()->json(['message' => 'Evento eliminado correctamente'], 200);
    }

    private function formatEvento(Evento $evento, bool $withContent = false): array
    {
        $imagenUrl = $evento->getFirstMediaUrl('imagen');

        if (! $imagenUrl && $evento->imagen) {
            $imagenUrl = asset('storage/'.$evento->imagen);
        }

        $data = [
            'id' => $evento->id,
            'titulo' => $evento->titulo,
            'descripcion' => $evento->descripcion,
            'lugar' => $evento->lugar,
            'fecha_evento' => $evento->fecha_evento?->format('Y-m-d'),
            'imagen' => $imagenUrl ?: null,
            'color' => $evento->color,
            'text_color' => $evento->text_color,
            'destacado' => $evento->destacado,
            'activa' => $evento->activa,
            'created_at' => $evento->created_at?->toISOString(),
            // Compatibilidad con frontend existente
            'dia' => $evento->fecha_evento?->day,
            'mes' => $evento->fecha_evento?->locale('es')->monthName,
            'mesNum' => $evento->fecha_evento?->month,
            'anio' => $evento->fecha_evento?->year,
            'date' => $evento->fecha_evento?->locale('es')->isoFormat('D [de] MMMM, YYYY'),
            'title' => $evento->titulo,
            'desc' => $evento->descripcion,
            'tag' => 'Evento',
        ];

        if ($withContent) {
            $data['body'] = $evento->contenido;
        }

        return $data;
    }
}