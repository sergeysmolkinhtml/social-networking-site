<?php

namespace App\Listeners;

use App\Notifications\WelcomeRegisterNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WelcomeEmailListener
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
     * @param Registered $event
     */
    public function handle(Registered $event): void
    {
        $event->user->notify(new WelcomeRegisterNotification());
    }
}
