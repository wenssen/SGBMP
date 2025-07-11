<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mantenimiento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log; // 👈 AÑADIDO

class RevisarMantenimientos extends Command
{
    protected $signature = 'mantenimientos:revisar';

    protected $description = 'Revisa si hay mantenimientos próximos y ejecuta la notificación si los hay.';

    public function handle()
    {
        // 👇 Log de ejecución automática
        Log::info('⏰ Comando mantenimientos:revisar ejecutado automáticamente a ' . now());

        $hoy = Carbon::now();
        $en3dias = $hoy->copy()->addDays(3);

        $hayPendientes = Mantenimiento::where('estado', 'pendiente')
            ->whereBetween('fecha_programada', [$hoy, $en3dias])
            ->exists();

        if ($hayPendientes) {
            $this->info('Se encontraron mantenimientos próximos. Ejecutando notificación...');
            Log::info('🔔 Se encontraron mantenimientos próximos, ejecutando notificar:mantenimientos-proximos');

            Artisan::call('notificar:mantenimientos-proximos');
            $this->info(Artisan::output());

            // También puedes loggear la salida si quieres
            Log::info('📝 Salida de notificar:mantenimientos-proximos: ' . Artisan::output());
        } else {
            $this->info('No hay mantenimientos pendientes próximos.');
            Log::info('✅ No se encontraron mantenimientos próximos para notificar.');
        }
    }
}

