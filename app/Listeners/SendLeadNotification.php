<?php

namespace App\Listeners;

use App\Events\LeadCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\LeadCreatedNotification;

class SendLeadNotification
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
    public function handle(LeadCreated $event): void
    {
        $lead = $event->lead;

        // Send email notification to the lead email
        $lead->notify(new LeadCreatedNotification($lead));
    }
}
