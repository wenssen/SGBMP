<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mantenimiento;
use Illuminate\Support\Facades\Mail;
use App\Mail\MantenimientoProximo;
use Carbon\Carbon;

class NotificarMantenimientosProximos extends Command
{
    protected $signature = 'notificar:mantenimientos-proximos';
    protected $description = 'Envía correos de mantenimiento programado entre hoy y 3 días más, solo si están pendientes';

    public function handle()
    {
        $hoy = Carbon::today();
        $limite = $hoy->copy()->addDays(3);

        $mantenimientos = Mantenimiento::with('bien')
            ->where('estado', 'pendiente')
            ->whereBetween('fecha_programada', [$hoy, $limite])
            ->get();

        if ($mantenimientos->isEmpty()) {
            $this->info('No hay mantenimientos próximos.');
            return Command::SUCCESS;
        }

        foreach ($mantenimientos as $mantenimiento) {
            // Usa el correo del responsable si es válido, o usa uno fijo para test
            $correo = filter_var($mantenimiento->responsable, FILTER_VALIDATE_EMAIL)
                ? $mantenimiento->responsable
                : 'edgarbkn321@gmail.com';

            Mail::to($correo)->send(new MantenimientoProximo($mantenimiento));
            $this->info("Correo enviado para el mantenimiento ID {$mantenimiento->id}.");
        }

        return Command::SUCCESS;
    }
}

