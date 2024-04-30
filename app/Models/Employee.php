<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_name',
        'employee_phone',
        'employee_email',
        'address',
        'own_user_id',
        'user_id'
    ];

    public function leave()
    {
        return $this->hasMany(Leave::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
