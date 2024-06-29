<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'email',
        'user_name',
        'password',
        'mobile_number',
        'street_address',
        'city',
        'post_code',
        'country'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'role_id' => 'integer',
        ];
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'role_id');
    }

  
    public function registration() 
    {
        return $this->hasMany('App\Models\Registration', 'register_id');
    }

  
    public function notification() 
    {
        return $this->hasMany('App\Models\Notification', 'notification_id');
    }

  
    public function evaluation() 
    {
        return $this->belongsTo('App\Models\Evaluation', 'evaluation_id');
    }


  public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'event_participants', 'user_id', 'event_id');
    }
}
