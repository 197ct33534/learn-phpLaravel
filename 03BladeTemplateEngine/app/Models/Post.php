<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categoies;
use App\Models\Comments;
use App\Models\Votes;


class Post extends Model
{
    use HasFactory, SoftDeletes;
    /* quy ước tên table
    tên model Post => table :posts
    tên model ProductCategory => table :product_categories
    */

    protected $table = 'posts';

    /**
     * quy uốc khóa chính
     * laravel sẽ lấy field id là khóa chính
     */
    protected $primaryKey = 'id';
    // public $incrementing = false;
    // protected $keyType = 'string';

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    public $timestamps = true;
    protected $attributes = [
        'status' => 0,
    ];

    protected $fillable = [
        'title',
        'content',
        'status'
    ];

    public function getCategoies()
    {
        return $this->belongsToMany(
            Categoies::class,
            'post_categoies', // bảng trung gian
            'posts_id', // khóa ngoại với bảng hiện tại
            'categoies_id' // khóa ngoại của bảng tham chiếu tới
        );
    }
    public function postComments()
    {
        return $this->hasMany(Comments::class, 'posts_id', 'id');
    }
    public function postVotes()
    {
        return $this->hasMany(Votes::class, 'posts_id', 'id');
    }
}
