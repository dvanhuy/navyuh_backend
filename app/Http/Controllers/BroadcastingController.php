<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class BroadcastingController extends Controller
{
    public function auth(Request $request)
    {
        $user = User::getUserFromToken($request);
        if (!$user) {
            return response()->json(['socket-error' => 'Unauthenticated'], 401);
        }
        $request->merge(['user' => $user]);
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        Auth::setUser($user);
        return Broadcast::auth($request);
    }
}
