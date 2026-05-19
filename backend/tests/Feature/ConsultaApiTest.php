<?php

namespace Tests\Feature;

use App\Models\Consulta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ConsultaApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, mixed>
     */
    private function validConsultaData(array $overrides = []): array
    {
        return array_merge([
            'nombre_completo' => 'Juan Pérez',
            'correo_electronico' => 'juan@example.com',
            'telefono' => '3884123456',
            'asunto' => 'Consulta general',
            'mensaje' => 'Me gustaría obtener más información sobre el sistema.',
        ], $overrides);
    }

    public function test_stores_a_consulta_from_frontend(): void
    {
        $response = $this->postJson('/api/consultas', $this->validConsultaData());

        $response->assertCreated()
            ->assertJsonFragment(['message' => 'Consulta enviada correctamente.']);

        $this->assertDatabaseHas('consultas', [
            'nombre_completo' => 'Juan Pérez',
            'correo_electronico' => 'juan@example.com',
            'estado' => 'pendiente',
        ]);
    }

    public static function requiredFieldsProvider(): array
    {
        return [
            'nombre_completo' => ['nombre_completo'],
            'correo_electronico' => ['correo_electronico'],
            'telefono' => ['telefono'],
            'asunto' => ['asunto'],
            'mensaje' => ['mensaje'],
        ];
    }

    #[DataProvider('requiredFieldsProvider')]
    public function test_validates_required_fields(string $field): void
    {
        $data = $this->validConsultaData([$field => '']);

        $response = $this->postJson('/api/consultas', $data);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors($field);
    }

    public function test_validates_email_format(): void
    {
        $data = $this->validConsultaData(['correo_electronico' => 'not-an-email']);

        $response = $this->postJson('/api/consultas', $data);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors('correo_electronico');
    }

    public function test_defaults_estado_to_pendiente(): void
    {
        $this->postJson('/api/consultas', $this->validConsultaData())->assertCreated();

        $consulta = Consulta::query()->latest()->first();
        $this->assertEquals('pendiente', $consulta->estado);
    }
}
