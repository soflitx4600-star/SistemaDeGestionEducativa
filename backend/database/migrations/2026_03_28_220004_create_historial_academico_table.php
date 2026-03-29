<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_academico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();
            $table->foreignId('materia_id')->constrained('materias')->cascadeOnDelete();
            $table->foreignId('curso_id')->constrained('cursos')->cascadeOnDelete();
            $table->year('ciclo_lectivo');
            $table->enum('estado', ['cursando', 'aprobada', 'desaprobada', 'previa', 'libre'])->default('cursando');
            $table->decimal('nota_cursada', 4, 2)->nullable();
            $table->decimal('nota_final', 4, 2)->nullable();
            $table->timestamps();

            // Evita duplicados del mismo alumno en la misma materia dentro del mismo ciclo lectivo
            $table->unique(['alumno_id', 'materia_id', 'ciclo_lectivo']);
            // Índice para contar previas eficientemente
            $table->index(['alumno_id', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_academico');
    }
};
