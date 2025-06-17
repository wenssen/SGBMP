<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mantenimiento;
use Illuminate\Support\Facades\Log;

class RevisarMantenimientos extends Command
{
    protected $signature = 'mantenimientos:revisar';  // <- Este nombre es clave
    protected $description = 'Verifica mantenimientos próximos y vencidos';

    public function handle()
    {
        $hoy = now();

        $proximos = Mantenimiento::whereDate('fecha_programada', $hoy->copy()->addDays(3))->get();
        $vencidos = Mantenimiento::whereDate('fecha_programada', '<', $hoy)->where('estado', 'pendiente')->get();

        foreach ($proximos as $m) {
            Log::info("Mantenimiento próximo para el bien {$m->bien->id}: {$m->fecha_programada}");
        }

        foreach ($vencidos as $m) {
            Log::warning("Mantenimiento vencido para el bien {$m->bien->id}");
        }

        $this->info('Revisión de mantenimientos completada.');
    }
}
