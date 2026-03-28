<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_legajo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ficha_legajo_id')->constrained('ficha_legajos')->cascadeOnDelete();
            $table->enum('tipo_documento', [
                'dni_alumno',
                'dni_tutor',
                'cuil_alumno',
                'cuil_tutor',
                'constancia_alumno_regular',
                'certificado_7mo_grado',
            ]);
            $table->string('archivo_path', 500)->nullable();
            $table->enum('estado', ['pendiente', 'adjunto', 'validado', 'rechazado'])->default('pendiente');
            $table->date('fecha_vencimiento')->nullable();
            $table->foreignId('validado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('validado_at')->nullable();
            $table->timestamps();

            $table->unique(['ficha_legajo_id', 'tipo_documento']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos_legajo');
    }
};
