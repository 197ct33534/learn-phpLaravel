<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
