<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owners;
use App\Models\Cars;

class Mechanics extends Model
{
    use HasFactory;
    public function carOwner()
    {
        return $this->hasOneThrough(
            Owners::class, // table mún liên kết tới
            Cars::class, // table trung gian
            'mechanic_id', // khóa ngoại của table trung gian
            'car_id', // khóa ngoại của bảng mún liên kết tới
            'id', // khóa chính của bảng mún liên kết tới
            'id' // khóa chính của bảng trung gian
        );
    }
}
