<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Posts;
use App\Models\Server;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        try {
            return ResponseHelper::success(
                'Lấy dữ liệu bài đăng thành công',
                Posts::with('author')->paginate(30)
            );
        } catch (\Throwable $th) {
            return ResponseHelper::error($th);
        }
    }
}
