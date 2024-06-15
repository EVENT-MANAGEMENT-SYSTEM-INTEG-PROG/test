<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Event; // Import Event model

class EventNotification extends Notification
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You are invited to ' . $this->event->event_name)
                    ->action('View Event', url('/events'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'notification_message' => 'You are invited to ' . $this->event->event_name,
            'notification_status' => 'unread',
            'notification_type' => 'event',
            'notification_date_time' => now(),
            'organizer' => $this->event->organizer,
            'participants' => $this->event->participants,
        ];
    }
}
