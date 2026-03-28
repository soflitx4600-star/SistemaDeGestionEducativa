<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('dni', 15)->unique();
            $table->string('cuil', 20)->nullable()->unique();
            $table->enum('parentesco', ['padre', 'madre', 'tutor_legal', 'otro']);
            $table->string('telefono', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('domicilio', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};
