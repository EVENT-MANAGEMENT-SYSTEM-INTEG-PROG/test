<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';
    
    protected $primaryKey = 'register_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'register_status',
        'register_code',
        'register_date',
        'register_time'
    ];

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
