<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations';

    protected $primaryKey = 'evaluation_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'evaluation_rating',
        'remarks',
        'evaluation_status',
        'created_date_time'
    ];


    public function casts(): array
    {   
        return [
        ];
    }

    public function event()
    {
        return $this->hasMany('App\Models\Event', 'event_id');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User', 'user_id');
    }

}
