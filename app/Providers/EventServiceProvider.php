<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\Tenant\OrderPlacedEvent;
use App\Events\Platform\OrderStatusUpdateEvent;
use App\Listeners\Tenant\SendNotificationListener;
use SocialiteProviders\Apple\AppleExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;
use App\Listeners\Platform\SendOrderUpdateNotificationListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderPlacedEvent::class => [
            SendNotificationListener::class,
        ],
        OrderStatusUpdateEvent::class => [
            SendOrderUpdateNotificationListener::class,
        ],
        SocialiteWasCalled::class => [
            AppleExtendSocialite::class . '@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
