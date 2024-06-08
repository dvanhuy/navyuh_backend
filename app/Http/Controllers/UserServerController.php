<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\JoiningDetails;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class UserServerController extends Controller
{
    public function index(Request $request)
    {
        $user = User::getUserFromToken($request);
        $servers = JoiningDetails::where('user_id', $user['id'])->get();
        return response($servers);
    }

    public function show(Server $idserver)
    {
        return response($idserver);
    }

    public function getJoin(Request $request,Server $idserver)
    {
        $user = User::getUserFromToken($request);
        $join = DB::table('joining_details')
        ->where('user_id',$user->id)
        ->where('server_id',$idserver->id)
        ->first();
        if ($join){
            ResponseHelper::success(
                'Đã tham gia vào server rồi',
                statusCode:ResponseHelper::HTTP_SEE_OTHER
            );
        }
        return ResponseHelper::success("Lấy thông tin vào server thành công",$idserver);
    }

    public function join(Request $request,Server $idserver)
    {
        $user = User::getUserFromToken($request);
        $join = DB::table('joining_details')
        ->where('user_id',$user->id)
        ->where('server_id',$idserver->id)
        ->first();

        if ($join){
            return response([
                'message'=>'Đã tham gia vào server rồi'
            ],303); 
        }
        
        $check = JoiningDetails::create([
            'user_id' => $user->id,
            'server_id' =>  $idserver->id,
        ]);
        
        if ($check){
            return response([
                'message'=>'Đã tham gia vào server'
            ]);
        }

        return response([
            'message'=>'Đã tham gia vào server'
        ],422);
    }
    
}
