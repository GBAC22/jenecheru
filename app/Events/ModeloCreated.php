<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Modelo;

class ModeloCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $modelo;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return void
     */
    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
