<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'event_id',
        'schedule_date',
    ];

    // this is for casting
    protected $casts = [
        'schedule_date' => 'datetime:Y-m-d',
    ];

    // Relationship with the Event model
    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification', 'notification_id');
    }
}
