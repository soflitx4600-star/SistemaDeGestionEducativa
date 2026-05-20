<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoticiaController extends Controller
{
    /**
     * List all active noticias with pagination.
     */
    public function index(): JsonResponse
    {
        $noticias = Noticia::query()
            ->where('activa', true)
            ->with('categoria')
            ->latest()
            ->paginate(12);

        $noticias->getCollection()->transform(function (Noticia $noticia) {
            return $this->formatNoticia($noticia);
        });

        return response()->json($noticias);
    }

    /**
     * Display a single noticia by slug.
     */
    public function show(string $slug): JsonResponse
    {
        $noticia = Noticia::query()
            ->where('slug', $slug)
            ->where('activa', true)
            ->with('categoria')
            ->firstOrFail();

        return response()->json($this->formatNoticia($noticia, withContent: true));
    }

    /**
     * Store a newly created noticia in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'contenido' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activa' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['titulo']);
        $validated['activa'] = $validated['activa'] ?? true;

        $noticia = Noticia::create($validated);

        if ($request->hasFile('imagen')) {
            $noticia->addMediaFromRequest('imagen')
                ->toMediaCollection('imagen');
        }

        return response()->json($this->formatNoticia($noticia), 201);
    }

    /**
     * Update the specified noticia in storage.
     */
    public function update(Request $request, Noticia $noticia): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string|max:500',
            'contenido' => 'sometimes|string',
            'categoria_id' => 'sometimes|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activa' => 'boolean',
        ]);

        if (isset($validated['titulo'])) {
            $validated['slug'] = Str::slug($validated['titulo']);
        }

        $noticia->update($validated);

        if ($request->hasFile('imagen')) {
            $noticia->clearMediaCollection('imagen');
            $noticia->addMediaFromRequest('imagen')
                ->toMediaCollection('imagen');
        }

        return response()->json($this->formatNoticia($noticia));
    }

    /**
     * Remove the specified noticia from storage.
     */
    public function destroy(Noticia $noticia): JsonResponse
    {
        $noticia->delete();

        return response()->json(['message' => 'Noticia eliminada correctamente'], 200);
    }

    private function formatNoticia(Noticia $noticia, bool $withContent = false): array
    {
        $imagenUrl = $noticia->getFirstMediaUrl('imagen');

        if (! $imagenUrl && $noticia->imagen) {
            $imagenUrl = asset('storage/'.$noticia->imagen);
        }

        $data = [
            'id' => $noticia->id,
            'titulo' => $noticia->titulo,
            'slug' => $noticia->slug,
            'descripcion' => $noticia->descripcion,
            'imagen' => $imagenUrl ?: null,
            'tag' => $noticia->categoria ? $noticia->categoria->nombre : 'General',
            'date' => $noticia->created_at?->format('d M, Y'),
            'title' => $noticia->titulo,
            'excerpt' => $noticia->descripcion,
            'imageAlt' => $noticia->titulo,
            'categoria' => $noticia->categoria ? [
                'id' => $noticia->categoria->id,
                'nombre' => $noticia->categoria->nombre,
            ] : null,
            'created_at' => $noticia->created_at?->toISOString(),
        ];

        if ($withContent) {
            $data['body'] = $noticia->contenido;
        }

        return $data;
    }
}
