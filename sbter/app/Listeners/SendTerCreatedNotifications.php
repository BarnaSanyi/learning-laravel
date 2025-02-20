<?php

namespace App\Listeners;

use App\Events\TerCreated;
use App\Models\User;
use App\Notifications\NewTer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTerCreatedNotifications implements ShouldQueue
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
    public function handle(TerCreated $event): void
    {
        foreach (User::whereNot('id', $event->ter->user_id)->cursor() as $user) {
            $user->notify(new NewChirp($event->ter));
        }
    }
}
