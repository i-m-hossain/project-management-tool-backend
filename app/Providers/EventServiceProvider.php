<?php

namespace App\Providers;




use App\Events\TaskCreatedEvent;
use App\Listeners\SendTaskCreatedNotification;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = [
        TaskCreatedEvent::class => [SendTaskCreatedNotification::class]
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
