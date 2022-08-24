<?php

namespace App\Http\Middleware;

use App\Models\Managers;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuth
{

    public function handle(Request $request, Closure $next, ...$guards)
    {
        $token = $request->header('token');
        if (!$token) {
            return response(['code' => -1, 'message' => '暂无权限访问']);
        }
        $jwt = JWTAuth::setToken($token);
        try {
            $sub = $jwt->checkOrFail();
            if (!$sub) {
                return response(['code' => -1, 'message' => '重新登录']);
            }
    
            $id = $sub->getClaims()['sub']->getValue();
            $user = Managers::where('black', 0)->find($id);
            if (!$user) {
                return response(['code' => -1, 'message' => '暂无权限访问']);
            }
            return $next($request);
        } catch (\Throwable $th) {
            return response(['code' => -1, 'message' => $th->getMessage()]);
        }
    }
}
