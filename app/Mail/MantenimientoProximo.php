<?php

namespace App\Mail;

use App\Models\Mantenimiento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MantenimientoProximo extends Mailable
{
    use Queueable, SerializesModels;

    public $mantenimiento;

    public function __construct(Mantenimiento $mantenimiento)
    {
        $this->mantenimiento = $mantenimiento;
    }

    public function build()
    {
        return $this->subject('🔧 Mantenimiento próximo')
                    ->view('emails.mantenimiento_proximo');
    }
}

