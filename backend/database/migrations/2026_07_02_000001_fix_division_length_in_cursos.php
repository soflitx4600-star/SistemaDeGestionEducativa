<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Esta migración era para extender division de varchar(1) a varchar(10).
 * La corrección se aplicó directamente en 2026_03_28_214513_create_cursos_table.php.
 * Mantener este archivo para que no falle en entornos donde ya se corrió.
 * En producción / fresh install no hace nada (SQLite no soporta ALTER COLUMN).
 */
return new class extends Migration
{
    public function up(): void
    {
        // No-op: la corrección ya está en la migración original de cursos.
        // En instalaciones nuevas el campo ya nace con varchar(10).
    }

    public function down(): void
    {
        // No-op
    }
};
