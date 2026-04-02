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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_de_estudio_id')->constrained('plan_de_estudios')->cascadeOnDelete();
            $table->unsignedTinyInteger('anio');
            $table->string('division', 10); // soporta: '7ma', '8va', 'A', 'B', etc.
            $table->enum('turno', ['Mañana', 'Tarde'])->default('Mañana');
            $table->string('preceptor')->nullable();
            $table->year('ciclo_lectivo');
            $table->unsignedSmallInteger('cupo_maximo')->default(30);
            $table->unique(['anio', 'division', 'ciclo_lectivo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
