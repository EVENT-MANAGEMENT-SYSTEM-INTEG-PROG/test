<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name',
        'event_description',
        'event_time',
        'event_location',
        'event_status',
    ];

    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule', 'schedule_id');
    }

}
