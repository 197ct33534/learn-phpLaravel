<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Users;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';

    public function postsOfCountry()
    {
        return $this->hasManyThrough(
            Post::class, // table mún liên kết tới
            Users::class, // table trung gian
            'country_id', // khóa ngoại của bảng trung gian
            'user_id', // khóa ngoại của bảng mún liên kết tới
            'id', // khóa chính của bảng mún liên kết tới
            'id' // khóa chính của bảng  trung gian
        );
    }
}
