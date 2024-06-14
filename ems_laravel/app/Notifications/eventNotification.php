<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class eventNotification extends Notification
{
    use Queueable;

    protected $event_name;

    public function __construct($event_name)
    {
        $this->event_name = $event_name;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $notifiable->id,
            'notification_message' => 'You are invited to ' . $this->event_name,
            'notification_status' => 'unread',
            'notification_type' => 'event',
            'notification_date_time' => now(),
        ];
    }
}
