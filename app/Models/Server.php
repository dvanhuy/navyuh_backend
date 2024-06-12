<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'server_id','id');
    }
}
