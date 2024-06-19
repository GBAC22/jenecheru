<?php

namespace App\Listeners;

use App\Events\ModeloUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class LogModeloUpdated
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ModeloUpdated  $event
     * @return void
     */
    public function handle(ModeloUpdated $event)
    {
        if (auth()->check()) {  // Verificar si un usuario está autenticado
            Bitacora::create([
                'action' => 'Modificación de modelo',
                'details' => 'El modelo ' . $event->modelo->nombre . ' ha sido modificado.',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
