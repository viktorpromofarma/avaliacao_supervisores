<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessRoles extends Model
{
    protected $table = 'access_roles';

    protected $fillable = [
        'user_id',
        'root',
        'admin',
        'supervisor',
        'regional',
        'gerentes',
        'created_at'
    ];

    public $timestamps = false;
}
