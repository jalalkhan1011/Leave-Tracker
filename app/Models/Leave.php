<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'leave_type',
        'leave_status',
        'leave_rason',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
