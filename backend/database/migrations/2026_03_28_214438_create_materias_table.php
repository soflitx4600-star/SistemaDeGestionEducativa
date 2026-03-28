<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_de_estudio_id')->constrained('plan_de_estudios')->cascadeOnDelete();
            $table->string('nombre', 150);
            $table->enum('ciclo', ['comun', 'orientado'])->default('comun');
            $table->unsignedTinyInteger('anio_cursado');
            $table->unsignedTinyInteger('horas_semanales')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
