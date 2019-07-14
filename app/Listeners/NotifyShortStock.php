<?php

namespace App\Listeners;

use App\Events\ShortStock;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyShortStock
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
     * @param  ShortStock  $event
     * @return void
     */
    public function handle(ShortStock $event)
    {
        $event->item->inventories->each->notify($event->item, $event->quantity);
    }
}
