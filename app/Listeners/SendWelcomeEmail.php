<?php

namespace App\Listeners;

class SendWelcomeEmail
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
        $user = $event->user;
        // Logic to send welcome email to $user->email
        Mail::to($user->email)
            ->send(new WelcomeEmail($user));
    }
}
