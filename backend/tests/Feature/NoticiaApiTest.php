<?php

namespace Tests\Feature;

use App\Models\Noticia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoticiaApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_paginated_list_of_active_noticias(): void
    {
        Noticia::factory()->count(3)->create();
        Noticia::factory()->inactive()->count(2)->create();

        $response = $this->getJson('/api/noticias');

        $response->assertSuccessful()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'titulo', 'slug', 'descripcion', 'imagen', 'categoria', 'created_at'],
                ],
                'current_page',
                'last_page',
                'total',
            ]);
    }

    public function test_index_does_not_include_contenido(): void
    {
        Noticia::factory()->create();

        $response = $this->getJson('/api/noticias');

        $response->assertSuccessful();
        $firstNoticia = $response->json('data.0');
        $this->assertArrayNotHasKey('contenido', $firstNoticia);
    }

    public function test_returns_single_noticia_by_slug_with_contenido(): void
    {
        $noticia = Noticia::factory()->create(['slug' => 'test-noticia']);

        $response = $this->getJson('/api/noticias/test-noticia');

        $response->assertSuccessful()
            ->assertJsonFragment([
                'id' => $noticia->id,
                'slug' => 'test-noticia',
            ])
            ->assertJsonStructure([
                'id', 'titulo', 'slug', 'descripcion', 'contenido', 'imagen', 'categoria', 'created_at',
            ]);
    }

    public function test_returns_404_for_inactive_noticia(): void
    {
        Noticia::factory()->inactive()->create(['slug' => 'hidden-noticia']);

        $response = $this->getJson('/api/noticias/hidden-noticia');

        $response->assertNotFound();
    }

    public function test_returns_404_for_nonexistent_slug(): void
    {
        $response = $this->getJson('/api/noticias/does-not-exist');

        $response->assertNotFound();
    }

    public function test_includes_categoria_data(): void
    {
        $noticia = Noticia::factory()->create();

        $response = $this->getJson("/api/noticias/{$noticia->slug}");

        $response->assertSuccessful()
            ->assertJsonStructure([
                'categoria' => ['id', 'nombre'],
            ]);
    }
}
