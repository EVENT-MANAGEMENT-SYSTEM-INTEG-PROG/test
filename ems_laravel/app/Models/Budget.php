<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budget';
    protected $primaryKey = 'budget_id';

    protected $fillable = [
        'user_id',
        'budget_amount',
        'budget_description'
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'budget_amount' => 'float'
        ];
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'user_id');
    }
}
