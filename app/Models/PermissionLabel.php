<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_label'
    ];
}
