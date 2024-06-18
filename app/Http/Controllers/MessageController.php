<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Helpers\ImageHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\SendMessageRequest;
use App\Models\JoiningDetails;
use App\Models\Message;
use App\Models\MessageImage;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function store(SendMessageRequest $request)
    {
        $user = $request->user();
        if (!$request['content'] && !$request['images']) {
            return ResponseHelper::error(
                'Tin nhắn phải chứa nội dung hoặc ảnh',
                ResponseHelper::HTTP_BAD_REQUEST
            );
        }
        if($request['images']){
            $message = Message::create([
                // 'content' => $request['content'],
                'sender_id'=>$user->id,
                'server_id'=>$request['server_id']
            ]);
            foreach ($request['images'] as $value) {
                MessageImage::create([
                    'image_url'=> ImageHelper::save('message',$value),
                    'message_id'=>$message['id'],
                ]);
            }
        }
        if($request['content']){
            $message = Message::create([
                'content' => $request['content'],
                'sender_id'=>$user->id,
                'server_id'=>$request['server_id']
            ]);
        }

        // broadcast(new MessageSent($user,$request['message']));
        return ResponseHelper::success(
            'Gửi tin nhắn thânh công'
        )
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
