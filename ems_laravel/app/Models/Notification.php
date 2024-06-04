<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';


    protected $primaryKey = 'notification_id';



    public function user() {
        return $this->belongsTo('App/Models/User', 'user_id');
    }

    public function schedule() {
        return $this->belongsTo('App/Models/Schedule', 'schedule_id');
    }
}
