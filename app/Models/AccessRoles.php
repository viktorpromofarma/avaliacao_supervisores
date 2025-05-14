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
        'operator',
        'created_at'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
