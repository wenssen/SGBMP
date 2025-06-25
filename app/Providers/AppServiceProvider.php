<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Mantenimiento;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $hoy = Carbon::today();
            $tresDiasDespues = $hoy->copy()->addDays(3);

            $alertas = Mantenimiento::with('bien')
                ->where('estado', 'pendiente')
                ->whereBetween('fecha_programada', [$hoy, $tresDiasDespues])
                ->get();

            $view->with('alertas_mantenimiento', $alertas);
        });
    }
}

