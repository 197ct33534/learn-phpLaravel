<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'name',
        'user_id',

    ];
    // get info user created group
    public function postBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // get user from user_id
    public function getUser()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }
}
