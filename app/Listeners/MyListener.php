<?php

namespace App\Listeners;

use App\Events\MyEvent;

class MyListener
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
    public function handle(MyEvent $event): void
    {
        //
    }
}
