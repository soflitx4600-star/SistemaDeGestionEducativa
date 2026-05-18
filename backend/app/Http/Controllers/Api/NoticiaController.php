<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\JsonResponse;

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
     * @param array{
     *   id: int,
     *   titulo: string,
     *   slug: string,
     *   descripcion: string,
     *   contenido: string|null,
     *   imagen: string|null,
     *   categoria: array{id: int, nombre: string}|null,
     *   created_at: string|null,
     * } $return
     */
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
            'categoria' => $noticia->categoria ? [
                'id' => $noticia->categoria->id,
                'nombre' => $noticia->categoria->nombre,
            ] : null,
            'created_at' => $noticia->created_at?->toISOString(),
        ];

        if ($withContent) {
            $data['contenido'] = $noticia->contenido;
        }

        return $data;
    }
}
