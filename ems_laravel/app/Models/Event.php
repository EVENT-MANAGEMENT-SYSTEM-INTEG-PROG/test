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
        'participants',
        'user_id',
        'event_image', // Add event_image to fillable attributes
    ];

    protected $casts = [
        'participants' => 'array', // Cast participants attribute to array
    ];

    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule', 'event_id');
    }

    public function evaluation()
    {
        return $this->belongsTo('App\Models\Evaluation', 'evaluation_id');
    }
    
    public function whatUser() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function participants()
    {
        return $this->belongsToMany('App\Models\User', 'event_participants', 'event_id', 'user_id');
    }
}
