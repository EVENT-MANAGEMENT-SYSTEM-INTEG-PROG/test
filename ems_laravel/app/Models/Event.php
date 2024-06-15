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
        'event_date',
        'event_time',
        'event_location',
        'event_status', 
        'organizer',
        'participants'
    ];
    protected $casts = [
        'participants' => 'array', // Cast participants attribute to array
    ];
    
    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule', 'schedule_id');
    }

    public function evaluation()
    {
        return $this->belongsTo('App\Models\Evaluation', 'evaluation_id');
    }

}
