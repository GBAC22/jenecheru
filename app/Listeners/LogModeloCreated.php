<?php

namespace App\Listeners;

use App\Events\ModeloCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class LogModeloCreated
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ModeloCreated  $event
     * @return void
     */
    public function handle(ModeloCreated $event)
    {
        if (auth()->check()) {  // Verificar si un usuario está autenticado
            Bitacora::create([
                'action' => 'Creación de modelo',
                'details' => 'El modelo ' . $event->modelo->nombre . ' ha sido creado.',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
