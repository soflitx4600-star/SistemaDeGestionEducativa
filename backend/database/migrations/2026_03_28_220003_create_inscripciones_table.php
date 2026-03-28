<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();
            $table->foreignId('curso_id')->constrained('cursos')->cascadeOnDelete();
            $table->year('ciclo_lectivo');
            $table->enum('estado', ['activo', 'baja', 'egresado', 'repitiente', 'en_espera', 'promovido'])->default('activo');
            $table->date('fecha_inscripcion');
            $table->timestamps();

            $table->index(['alumno_id', 'ciclo_lectivo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
