<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable

{
    use HasApiTokens;
    protected $table = 'users';

    protected $primaryKey = 'user_id';


    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'email',
        'user_name',
        'mobile_number',
        'street_address',
        'city',
        'post_code',
        'password',
        'country',
        'role_id'
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
        return $this->hasOne('App\Models\Role','role_id');
    }

    
    

}
