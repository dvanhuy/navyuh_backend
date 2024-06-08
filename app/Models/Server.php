<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    protected $table = 'servers';
    protected $fillable = [
        'name',
        'password',
        'creator_id',
        'images',
        'description',
        'findable',
        'joinable',
    ];
}
