<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionLabelCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_label',
        'role_name',
        'role_id',
        'check_status'
    ];
}
