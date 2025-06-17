<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos disponibles para la aplicaci�n.
     */
    protected $commands = [
        Commands\RevisarMantenimientos::class, // <- a�ade tus comandos aqu�
    ];

    /**
     * Define la programaci�n de comandos de Artisan.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('mantenimientos:revisar')->dailyAt('08:00'); // o cuando prefieras
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
