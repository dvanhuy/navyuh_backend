<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Helpers\ResponseHelper;
use App\Models\JoiningDetails;
use App\Models\Message;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $user = User::getUserFromToken($request);
        $check = Message::create([
            'content' => $request['message'],
            'sender_id'=>$user->id,
            'server_id'=>$request['server_id']
        ]);
        broadcast(new MessageSent($user,$request['message']));
        return response($user->id);
    }

    public function index(Request $request,Server $serverID)
    {
        $user = User::getUserFromToken($request);
        $exists = JoiningDetails::isServerMember($user->id,$serverID->id);
        if (!$exists){
            ResponseHelper::error('Bạn chưa tham gia vào máy chủ này',ResponseHelper::HTTP_UNAUTHORIZED);
        }
        $messages = Message::where('server_id',$serverID->id)->paginate(20);
        return ResponseHelper::success('Get messages success',$messages);
    }
}
