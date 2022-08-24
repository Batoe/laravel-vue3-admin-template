<?php

namespace App\Http\Controllers;

use App\Models\Managers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    //
    public $loginAfterSignUp = true;

    public function register()
    {
        $user = new Managers();
        $user->username = request('username');
        $user->salt = random_str(8);
        $user->password = md5(request('password') . $user->salt);
        $user->save();

        return response(['code' => 20000, 'message' => '注册成功', 'data' => $user]);
    }

    public function login(Request $request)
    {
        $input = $request->only('username', 'password');
        $jwt_token = null;

        $manager = Managers::where('username', $input['username'])->where('black', 0)->first();
        if (!$manager) {
            return response(['code' => 1, 'message' => '账号不存在']);
        }
        if ($manager->password != md5($input['password'] . $manager->salt)) {
            return response(['code' => 1, 'message' => '密码错误']);
        }
        $jwt_token = JWTAuth::fromUser($manager);
        $manager->last_login_time = timer();
        $manager->last_login_ip = request()->getClientIp();
        $manager->save();

        unset($manager->salt, $manager->password, $manager->deleted_at);

        clog('登录', $manager, '用户登录');
        return response(['code' => 200, 'message' => '登录成功', 'data' => [
            'token' => $jwt_token,
        ]]);
    }

    public function logout(Request $request)
    {
        $token = $request->header('token');
        $jwt = JWTAuth::setToken($token);
        JWTAuth::invalidate($token);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $token = $request->header('token');
        $jwt = JWTAuth::setToken($token);
        $sub = $jwt->checkOrFail();
        if (!$sub) {
            return response(['code' => -1, 'message' => '重新登录']);
        }

        $id = $sub->getClaims()['sub']->getValue();
        $user = Managers::where('black', 0)->find($id);
        if (!$user) {
            return response(['code' => -1, 'message' => '暂无权限访问']);
        }
        $user->makeHidden(['salt', 'password', 'deleted_at', 'black']);
        // $user->permissions = ['admin'];
        $permission = cache('role_' . $user->role) ?: (object) [];
        $is_dev = env('APP_DEV');
        if ($is_dev) {
            $user->permission = get_permission();
        } else {
            $user->permission = $permission;
        }
        return response()->json(['code' => 200, 'message' => 'success' , 'data' => $user]);
    }
}
