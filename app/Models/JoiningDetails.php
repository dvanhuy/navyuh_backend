<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoiningDetails extends Model
{
    use HasFactory;
    protected $table = 'joining_details';
    protected $fillable = [
        'user_id',
        'server_id',
        'role',
    ];

    public static function isServerMember($userID, $serverID)
    {
        return JoiningDetails::where('user_id',$userID)->where('server_id',$serverID)->exists();
    }
}
