<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table= 'users';
    protected $fillable = [
        'Username',
        'Password',
        'Email',
        'PhoneNumber',
        'Address',
        'Role',
    ];

    protected $hidden = [
        'Password',
    ];

    protected $casts = [
        'EmailVerifiedAt' => 'datetime',
    ];
    protected $primaryKey = 'UserID';

}
