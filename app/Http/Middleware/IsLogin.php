<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = User::getUserFromToken($request);
            if ($user){
                $request->merge(['user' => $user]);
                $request->setUserResolver(function () use ($user) {
                    return $user;
                });
                Auth::setUser($user);
                return $next($request);
            }
        } catch (\Throwable $th) {
            ResponseHelper::error('Server lỗi :'.$th,ResponseHelper::HTTP_UNAUTHORIZED);
        }
        return ResponseHelper::error('Chưa đang nhập',ResponseHelper::HTTP_UNAUTHORIZED);
    }
}
