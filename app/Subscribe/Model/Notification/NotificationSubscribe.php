<?php

namespace App\Subscribe\Model\Notification;

use Illuminate\Bus\Dispatcher;

class NotificationSubscribe
{
    public function subscribe(Dispatcher $dispatcher){
        $dispatcher->listener();
    }
}
