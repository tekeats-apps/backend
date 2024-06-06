<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\OrderPlacedEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Tenant\OrderPlacedNotification;

class SendNotificationListener
{
    public function handle(OrderPlacedEvent $event)
    {
        Notification::send($event->order->customer, new OrderPlacedNotification($event->order));
    }
}
