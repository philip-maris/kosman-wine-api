<?php

namespace App\Events\Model\Notification;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationForCreatingEvent
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
