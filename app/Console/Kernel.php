<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos disponibles para la aplicación.
     */
    protected $commands = [
        \App\Console\Commands\RevisarMantenimientos::class,
        \App\Console\Commands\NotificarMantenimientosProximos::class,
    ];

    /**
     * Define la programación de comandos de Artisan.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Ejecuta el comando todos los días a las 08:00 hora Chile
        $schedule->command('mantenimientos:revisar')
            ->dailyAt('08:00')
            ->timezone('America/Santiago');
    }

    /**
     * Registra los comandos para Artisan.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

