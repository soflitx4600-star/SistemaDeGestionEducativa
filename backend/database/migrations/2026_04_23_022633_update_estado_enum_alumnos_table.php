<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Convertir estados viejos a 'regular' antes de cambiar el enum
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');
            DB::statement('PRAGMA ignore_check_constraints = ON');
            DB::update("UPDATE alumnos SET estado = 'regular' WHERE estado IN ('preinscripto', 'sorteado', 'inscripto')");
            DB::statement('PRAGMA ignore_check_constraints = OFF');
            DB::statement('PRAGMA foreign_keys = ON');
        } else {
            DB::table('alumnos')
                ->whereIn('estado', ['preinscripto', 'sorteado', 'inscripto'])
                ->update(['estado' => 'regular']);

            DB::statement("ALTER TABLE alumnos MODIFY COLUMN estado ENUM('regular','egresado','abandono','suspendido') NOT NULL DEFAULT 'regular'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE alumnos MODIFY COLUMN estado ENUM('regular','egresado','abandono','suspendido','preinscripto','sorteado','inscripto') NOT NULL DEFAULT 'regular'");
        }
    }
};
