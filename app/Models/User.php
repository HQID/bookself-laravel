<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users'; // Pastikan ini ada
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
