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
    Schema::create('equipos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('tipo')->nullable();
        $table->string('ubicacion')->nullable();
        $table->unsignedInteger('umbral_alerta_segundos')->default(90);
        $table->enum('estado_actual', ['activo', 'caido'])->default('activo');
        $table->timestamp('ultimo_heartbeat_en')->nullable();
        $table->boolean('modo_demo_forzado')->default(false);
        $table->timestamps();

        $table->index('estado_actual');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
