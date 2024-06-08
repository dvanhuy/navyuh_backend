<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'images',
        'server_id',
    ];

    public function author(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    // public function getImagesAttribute($value)
    // {
    // }
}
