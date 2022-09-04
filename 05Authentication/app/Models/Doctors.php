<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Doctors extends Authenticatable
{
    use  HasFactory, Notifiable;
    protected $table = 'doctors';
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active'
    ];
}
