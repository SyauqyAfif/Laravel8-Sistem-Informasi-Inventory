<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';

    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}