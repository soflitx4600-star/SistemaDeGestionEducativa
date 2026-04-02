<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained('cursos')->cascadeOnDelete();
            $table->foreignId('materia_id')->constrained('materias')->cascadeOnDelete();
            $table->foreignId('docente_id')->constrained('docentes')->cascadeOnDelete();
            $table->enum('dia_semana', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes']);
            $table->unsignedTinyInteger('hora_catedra'); // 1 a 7
            $table->timestamps();

            $table->unique(['curso_id', 'dia_semana', 'hora_catedra'], 'horario_celda_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
