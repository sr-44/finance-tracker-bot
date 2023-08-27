<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $fillable = [
        'chat_id',
        'username',
        'last_activity',
    ];


    protected $casts = [
        'last_activity' => 'datetime',
    ];
    protected $primaryKey = 'chat_id';
}
