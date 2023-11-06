<?php

namespace App\Listeners;

// use App\Events\SendNotify;

use App\Models\Admin;
use App\Notifications\CreatedOrderNotification;
use App\Notifications\CreatedOrderNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotify
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
    public function handle($event): void
    {
        $users = Admin::where('owner', 1)->get();
        Notification::send($users, new CreatedOrderNotify($event->order->first()));
    }
}
