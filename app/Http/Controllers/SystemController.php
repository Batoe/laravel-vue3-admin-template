<?php

namespace App\Http\Controllers;

use App\Models\Managers;
use App\Models\Roles;
use Illuminate\Support\Facades\Cache;

class SystemController extends Controller
{

    /**
     * 获取全部权限
     */
    public function getAllPermissions()
    {
        $permission = config('permission');
        return response(['code' => 200, 'message' => 'success', 'data' => $permission]);
    }

    /**
     * 保存角色
     */
    public function saveRole()
    {
        $id = request('id');
        $name = request('name');
        $permission = request('permission');

        if (!trim($name)) {
            return response(['code' => 501, 'message' => '输入正确的角色名称']);
        }

        if ($id) {
            $role = Roles::find($id);
            if (!$role) {
                return response(['code' => 501, 'message' => '不存在的角色']);
            }
            if ($role->name != $name) {
                $role->name = $name;
                $role->save();
            }
            clog('修改', $role, '修改角色');
        } else {
            $role = new Roles();
            $role->name = $name;
            $role->save();
            clog('新增', $role, '新增角色');
        }

        $cache = ['role_' . $role->id => $permission];
        cache($cache);
        return response(['code' => 200, 'message' => '保存成功', 'data' => cache('role_' . $role->id)]);
    }

    /**
     * 获取角色
     */
    public function getRole()
    {
        $roles = Roles::orderByDesc('id')->get();
        foreach ($roles as &$role) {
            $role->permission = cache('role_' . $role->id) ?: get_permission();
        }
        return response(['code' => 200, 'message' => 'success', 'data' => $roles]);
    }

    /**
     * 删除角色
     */
    public function deleteRole($id)
    {
        $role = Roles::find($id);
        $role->delete();

        clog('删除', $role, '删除角色');

        Cache::forget("role_" . $id);
        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 获取用户
     */
    public function getManagers()
    {
        $listQuery = request('listQuery');
        $listQuery = @(array)json_decode($listQuery);
        $role = intval($listQuery['role'] ?? '');
        $kw = trim($listQuery['kw'] ?? '');
        $page = intval($listQuery['page']);
        $limit = intval($listQuery['limit']);
        $status = $listQuery['status'] ?? "";

        $manager = Managers::with(['roles'])
            ->when(!empty($kw), function ($query) use ($kw) {
                $kw = '%' . $kw . '%';
                $query->where('username', 'like', $kw);
            })
            ->when($role, function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->when($status != '', function ($query) use ($status) {
                $query->where('black', $status);
            })
            ->select('id', 'username', 'created_at', 'last_login_ip', 'last_login_time', 'role', 'black');
        $total = $manager->count();
        $manager = $manager->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();

        return response(['code' => 200, 'message' => 'success', 'data' => $manager, 'total' => $total]);
    }

    /**
     * 保存用户
     */
    public function saveManager()
    {
        $form = request(['id', 'username', 'password', 'role']);
        if (!trim($form['username'])) {
            return response(['code' => 502, 'message' => '请输入正确的用户名']);
        }
        if (!intval($form['role'])) {
            return response(['code' => 502, 'message' => '请输入选择正确的角色']);
        }
        if ($form['id']) {
            $manager = Managers::find($form['id']);
            $manager->username = trim($form['username']);
            if ($form['password']) {
                $manager->salt = random_str(8);
                $manager->password = md5($form['password'] . $manager->salt);
            }
            $manager->role = intval($form['role']);
            $manager->save();
            clog('修改', $manager, '修改用户');
        } else {
            if (!trim($form['password'])) {
                return response(['code' => 502, 'message' => '请输入正确的密码']);
            }
            $manager = new Managers();
            $manager->username = trim($form['username']);
            $manager->salt = random_str(8);
            $manager->password = md5($form['password'] . $manager->salt);
            $manager->role = intval($form['role']);
            $manager->save();
            clog('新增', $manager, '新增用户');
        }
        return response(['code' => 200, 'message' => '保存成功']);
    }

    /**
     * 删除用户
     */
    public function deleteManager($id)
    {
        $manager = Managers::find($id);
        if (!$manager) {
            return response(['code' => 501, 'message' => '不存在的账号']);
        }
        $manager->delete();
        clog('删除', $manager, '删除用户');
        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 拉黑/取消拉黑
     */
    public function pullBlack($id) {
        $manager = Managers::find($id);
        if (!$manager) {
            return response(['code' => 501, 'message' => '不存在的账号']);
        }
        $status = intval(request('status'));
        if ($manager->black != $status) {
            $manager->black = $status;
            $manager->save();
            clog($status ? '拉黑' : '恢复', $manager, ($status ? '拉黑' : '恢复') . '用户');
        }
        return response(['code' => 200, 'message' => '修改成功']);
    }
}
