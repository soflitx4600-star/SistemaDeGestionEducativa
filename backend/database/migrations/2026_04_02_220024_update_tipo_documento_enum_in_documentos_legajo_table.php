<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite no soporta ALTER COLUMN en enums, se recrea la tabla
        Schema::table('documentos_legajo', function (Blueprint $table) {
            $table->string('tipo_documento', 50)->change();
        });
    }

    public function down(): void
    {
        //
    }
};
