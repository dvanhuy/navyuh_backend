<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = [
        'content',
        'type',
        'sender_id',
        'server_id',
    ];

    public function messageImages(): HasMany
    {
        return $this->hasMany(MessageImage::class, 'message_id','id');
    }
    
}
