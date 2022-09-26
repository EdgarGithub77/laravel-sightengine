<?php

namespace App\Listeners;

use App\Events\SightengineEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SightengineFileListener implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(SightengineEvent $event)
    {
        Log::info([$event]);
        return $event;
    }
}
