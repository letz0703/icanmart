<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BoxWasCreated extends Notification
{
    use Queueable;
    /**
     * @var
     */
    public $box;
    
    /**
     * Create a new notification instance.
     *
     * @param $box \App\Box
     */
    public function __construct($box)
    {
        //
        $this->box = $box;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }
    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //'message' => 'new Box was Created'
            'message' => $this->box->title.' was created by '.$this->box->creator->name,
            'link' => $this->box->path()
        ];
    }
}
