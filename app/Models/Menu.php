<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'menu_name',
        'menu_url',
        'parent_id',
        'parent_id2',
        'menu_level',
        'created_at',
        'updated_at',
        'menu_order',
        'status',
        'icon',
        'description',
        'posted_user',
        'posted_ip',
        'posted_userid',
    ];
}
