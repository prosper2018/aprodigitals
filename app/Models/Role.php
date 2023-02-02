<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'role_name',
        'role_enabled',
        'created',
        'requires_login',
        'posted_user',
        'posted_ip',
        'posted_userid',
        'is_deleted',
    ];

}
