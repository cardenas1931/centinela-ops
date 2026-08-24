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
    Schema::create('incidencias', function (Blueprint $table) {
        $table->id();
        $table->foreignId('equipo_id')->constrained('equipos')->cascadeOnDelete();
        $table->timestamp('inicio_en');
        $table->timestamp('fin_en')->nullable();
        $table->unsignedInteger('duracion_segundos')->nullable();
        $table->enum('origen', ['automatico', 'forzado_demo']);
        $table->boolean('notificacion_enviada')->default(false);
        $table->timestamps();

        $table->index(['equipo_id', 'fin_en']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
