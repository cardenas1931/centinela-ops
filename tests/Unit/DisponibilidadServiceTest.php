<?php

namespace Tests\Unit;

use App\Models\Equipo;
use App\Services\DisponibilidadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class DisponibilidadServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_calcula_uptime_correcto_sin_incidencias(): void
    {
        $equipo = Equipo::create(['nombre' => 'Equipo sin fallas']);
        $desde = Carbon::parse('2026-08-01 00:00:00');
        $hasta = Carbon::parse('2026-08-02 00:00:00');

        $resultado = (new DisponibilidadService())->calcularDisponibilidad($equipo, $desde, $hasta);

        $this->assertEquals(100.0, $resultado['porcentaje_uptime']);
        $this->assertEquals(0, $resultado['downtime_segundos']);
        $this->assertEquals(0, $resultado['numero_incidencias']);
    }

    public function test_calcula_uptime_con_una_incidencia_cerrada(): void
    {
        $equipo = Equipo::create(['nombre' => 'Equipo con falla']);
        $desde = Carbon::parse('2026-08-01 00:00:00');
        $hasta = Carbon::parse('2026-08-02 00:00:00'); // 24h = 86400s

        // Incidencia de 1 hora (3600s) dentro del rango
        $equipo->incidencias()->create([
            'inicio_en' => Carbon::parse('2026-08-01 10:00:00'),
            'fin_en' => Carbon::parse('2026-08-01 11:00:00'),
            'origen' => 'automatico',
        ]);

        $resultado = (new DisponibilidadService())->calcularDisponibilidad($equipo, $desde, $hasta);

        $this->assertEquals(3600, $resultado['downtime_segundos']);
        $this->assertEquals(1, $resultado['numero_incidencias']);
        // (86400 - 3600) / 86400 * 100 = 95.83%
        $this->assertEquals(95.83, $resultado['porcentaje_uptime']);
    }

    public function test_cierra_incidencia_abierta_correctamente(): void
    {
        $equipo = Equipo::create(['nombre' => 'Equipo para cerrar']);
        $equipo->incidencias()->create([
            'inicio_en' => now()->subMinutes(5),
            'origen' => 'forzado_demo',
        ]);

        $incidenciaCerrada = (new DisponibilidadService())->cerrarIncidenciaAbierta($equipo);

        $this->assertNotNull($incidenciaCerrada->fin_en);
        $this->assertGreaterThanOrEqual(299, $incidenciaCerrada->duracion_segundos);
    }
}