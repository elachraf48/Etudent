<?php

namespace App\Listeners;

use App\Events\ModuleStatusUpdateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ModuleStatusUpdateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ModuleStatusUpdateEvent  $event
     * @return void
     */
    public function handle(ModuleStatusUpdateEvent $event)
    {
        $event->handle();
    }
}
