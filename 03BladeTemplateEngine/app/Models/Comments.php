<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Comments extends Model
{
    use HasFactory;

    public function postComments()
    {
        return $this->hasMany(Post::class, 'posts_id', 'id');
    }
}
