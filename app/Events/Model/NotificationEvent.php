<?php

namespace App\Events\Model;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $items;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($items)
    {
        $this->items = $items;
    }


}
