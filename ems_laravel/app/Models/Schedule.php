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
    public function casts(): array
    {
        return [
            'schedule_date' => 'datetime:Y-m-d',
        ];
    }

    //relationship
    public function event()
    {
        return $this->hasOne('App\Models\Event', 'event_id');
    }

}