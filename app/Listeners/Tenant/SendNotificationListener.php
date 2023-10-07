<?php

namespace App\Listeners\Tenant;

use NotificationService;
use App\Events\OrderPlacedEvent;

class SendNotificationListener
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(OrderPlacedEvent $event)
    {
        $this->notificationService->sendOrderNotification($event->order);
    }
}
