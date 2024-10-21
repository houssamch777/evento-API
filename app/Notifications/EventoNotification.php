<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $title;
    protected $message;
    protected $image;
    protected $url;

    public function __construct($title, $message, $image = null, $url = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->image = $image;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
{
    return [
        'title' => $this->title,
        'image' => $this->image,
        'url' => $this->url,
        'message' => $this->message,

    ];
}
}
