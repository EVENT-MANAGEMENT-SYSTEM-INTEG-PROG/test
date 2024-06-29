<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;

class EventNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->view('emails.eventNotification')
                    ->with([
                        'eventName' => $this->event->event_name,
                        'eventDescription' => $this->event->event_description,
                        'eventDate' => $this->event->event_date,
                        'eventTime' => $this->event->event_time,
                        'eventLocation' => $this->event->event_location,
                    ]);
    }
}
