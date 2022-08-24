<?php

if (!function_exists('random_str')) {
    function random_str($length = 4)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
            'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
        );
        // 在 $chars 中随机取 $length 个数组元素键名
        $keys = array_rand($chars, $length);

        $password = '';
        for ($i = 0; $i < $length; $i++) { // 将 $length 个数组元素连接成字符串 
            $password .= $chars[$keys[$i]];
        }
        return $password;
    }
}

if (!function_exists('timer')) {
    function timer() {
        date_default_timezone_set('Etc/GMT-8');
        return date('Y-m-d H:i:s', time());
    }
}

if (!function_exists('get_permission')) {
    function get_permission ($all = false) {
        $permission = [];
        if (gettype($all) == 'boolean' && !$all) {
            $all = config('permission');
        } elseif (isset($all['items'])) {
            return array_keys($all['items']);
        } elseif (isset($all['children'])) {
            foreach ($all['children'] as $k => $e) {
                $permission[$k] = get_permission($e);
            }
            return $permission;
        }
        foreach ($all as $key => $item) {
            if (isset($item['items'])) {
                $permission[$key] = array_keys($item['items']);
            } elseif (isset($item['children'])) {
                foreach ($item['children'] as $k => $e) {
                    $permission[$key][$k] = get_permission($e);
                }
            }
        } 
        return $permission;
    }
}

use App\Models\Managers;
use App\Models\OperationLog;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;
if (!function_exists('get_manager_id')) {
    function get_manager_id () {
        $token = request()->header('token');
        if (!$token) return 0;
        $jwt = JWTAuth::setToken($token);
        $sub = $jwt->checkOrFail();
        if (!$sub) {
            return 0;
        }
        return $sub->getClaims()['sub']->getValue();
    }
}

if (!function_exists('clog')) {
    function clog($type, $model, $remark) {
        $mid = get_manager_id();
        if ($mid) {
            $manager = Managers::find($mid);

            $log = new OperationLog();
            $log->manager_id = $mid;
            $log->username = $manager->username;
            $log->type = $type;
            $log->table = $model instanceof Model ? $model->getTable() : $model;
            $log->table_id = $model->id ?? 0;
            $log->remark = $remark;
            $log->ip = request()->getClientIp();
            $log->save();
        } else {
            if ($type == '登录') {
                $log = new OperationLog();
                $log->manager_id = $mid;
                $log->username = $model->username;
                $log->type = $type;
                $log->table = $model instanceof Model ? $model->getTable() : $model;
                $log->table_id = $model->id ?? 0;
                $log->remark = $remark;
                $log->ip = request()->getClientIp();
                $log->save();
            }
        }
    }
}