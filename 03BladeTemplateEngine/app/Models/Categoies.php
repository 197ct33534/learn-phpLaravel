<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Categoies extends Model
{
    use HasFactory;
    protected $table = 'categoies';

    public function getPosts()
    {
        return $this->belongsToMany(Post::class, 'post_categoies', 'categoies_id', 'posts_id')
            ->withPivot('created_at')
            ->wherePivot('status', '1');
    }
}
