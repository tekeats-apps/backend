<?php

namespace App\Listeners\Platform;

use Illuminate\Support\Facades\Notification;
use App\Notifications\Platform\OrderStatusNotification;

class SendOrderUpdateNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Notification::send($event->order->customer, new OrderStatusNotification($event->order));
    }
}
