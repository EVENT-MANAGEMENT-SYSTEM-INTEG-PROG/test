<?php

namespace App\Models;

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
        'register_date_time'
    ];

    public function casts(): array
    {
        return [
            'register_date' => 'datetime',
            'register_date_time' => 'datetime',
        ];
    }

}
