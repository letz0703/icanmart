<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OutOfStock extends Notification
{
    use Queueable;
    /**
     * @var
     */
    protected $item;
    
    /**
     * Create a new notification instance.
     */
    
    public function __construct($item)
    {
        $this->item = $item;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Item is about to out of stock. Purchase It',
        ];
    }
}
