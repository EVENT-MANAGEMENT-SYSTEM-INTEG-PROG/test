<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'schedule_id',
        'notification_message',
        'notification_status',
        'notification_type',
        'notification_date_time',
        'organizer',
        'participants'
    ];
}



