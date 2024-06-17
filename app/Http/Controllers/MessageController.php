<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Helpers\ResponseHelper;
use App\Http\Requests\SendMessageRequest;
use App\Models\JoiningDetails;
use App\Models\Message;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(SendMessageRequest $request)
    {
        $user = $request->user();
        $check = Message::create([
            'content' => $request['message'],
            'sender_id'=>$user->id,
            'server_id'=>$request['server_id']
        ]);
        // broadcast(new MessageSent($user,$request['message']));
        return response($user->id);
    }

    public function index(Request $request,Server $serverID)
    {
        $user = $request->user();
        $exists = JoiningDetails::isServerMember($user->id,$serverID->id);
        if (!$exists){
            ResponseHelper::error('Bạn chưa tham gia vào máy chủ này',ResponseHelper::HTTP_UNAUTHORIZED);
        }
        $messages = Message::where('server_id',$serverID->id)
                            ->orderByDesc('created_at')
                            ->orderBy('id')
                            ->paginate(20);
        return ResponseHelper::success('Get messages success',$messages);
    }
}
