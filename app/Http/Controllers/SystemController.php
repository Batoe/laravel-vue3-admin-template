<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Managers;
use App\Models\Products;
use App\Models\Roles;
use App\Models\Stock;
use App\Models\Warehouses;
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

    /**
     * 获取产品
     */
    public function getProducts() {
        $listQuery = request(['kw', 'page', 'limit']);
        $kw = trim($listQuery['kw']) ? '%' . trim($listQuery['kw']) . '%' : '';
        $page = intval($listQuery['page']);
        $limit = intval($listQuery['limit']);

        $list = Products::when($kw, function ($query) use ($kw) {
            $query->where('name', 'like', $kw);
        });
        $total = $list->count();
        $list = $list->offset(($page - 1) * $limit)->limit($limit)->get();
        return response(['code' => 200, 'message' => 'success', 'data' => $list, 'total' => $total]);
    }

    /**
     * 保存商品
     */
    public function saveProduct() {
        $form = request(['id', 'name', 'unit', 'price']);
        if (!trim($form['name'])) {
            return response(['code' => 501, 'message' => '请输入正确的产品名称']);
        }
        if (!trim($form['unit'])) {
            return response(['code' => 501, 'message' => '请输入正确的产品名称']);
        }
        if ($form['id']) {
            $product = Products::find($form['id']);
        } else {
            $product = new Products();
        }
        $product->name = trim($form['name']);
        $product->unit = trim($form['unit']);
        $product->price = floatval($form['price']);
        $product->save();

        $stocks = Products::where('products.id', $product->id)->crossJoin('warehouses')->select('products.id as product_id', 'warehouses.id as warehouse_id')->get();
        foreach ($stocks as $item) {
            $stock = Stock::where('product_id', $item->product_id)->where('warehouse_id', $item->warehouse_id)->first();
            if (!$stock) {
                $stock = new Stock();
                $stock->warehouse_id = $item->warehouse_id;
                $stock->product_id = $item->product_id;
                $stock->unit = $product->unit;
                $stock->save();
            }
        }

        if ($form['id'])
            clog('修改', $product, '修改产品');
        else
            clog('新增', $product, '新增产品');

        return response(['code' => 200, 'message' => '保存成功']);
    }

    /**
     * 删除产品
     */
    public function deleteProduct($id) {
        $product = Products::find($id);
        if (!$product) {
            return response(['code' => 501, 'message' => '不存在的产品']);
        }
        $product->delete();
        clog('删除', $product, '删除产品');
        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 获取仓库
     */
    public function getWareHouses() {
        $listQuery = request(['kw', 'page', 'limit']);
        $kw = trim($listQuery['kw']) ? '%' . trim($listQuery['kw']) . '%' : '';
        $page = intval($listQuery['page']);
        $limit = intval($listQuery['limit']);

        $list = Warehouses::when($kw, function ($query) use ($kw) {
            $query->where('name', 'like', $kw);
        });
        $total = $list->count();
        $list = $list->offset(($page - 1) * $limit)->limit($limit)->get();
        return response(['code' => 200, 'message' => 'success', 'data' => $list, 'total' => $total]);
    }

    /**
     * 保存仓库
     */
    public function saveWareHouse() {
        $form = request(['id', 'name', 'address']);
        if (!trim($form['name'])) {
            return response(['code' => 501, 'message' => '请输入正确的仓库名称']);
        }
        if ($form['id']) {
            $warehouse = Warehouses::find($form['id']);
        } else {
            $warehouse = new Warehouses();
        }
        $warehouse->name = trim($form['name']);
        $warehouse->address = trim($form['address']);
        $warehouse->save();

        $stocks = Warehouses::where('warehouses.id', $warehouse->id)->crossJoin('products')->select('products.id as product_id', 'warehouses.id as warehouse_id', 'unit')->get();
        foreach ($stocks as $item) {
            $stock = Stock::where('product_id', $item->product_id)->where('warehouse_id', $item->warehouse_id)->first();
            if (!$stock) {
                $stock = new Stock();
                $stock->warehouse_id = $item->warehouse_id;
                $stock->product_id = $item->product_id;
                $stock->unit = $item->unit;
                $stock->save();
            }
        }
        
        if ($form['id']) 
            clog('修改', $warehouse, '修改仓库');
        else
            clog('新增', $warehouse, '新增仓库');
        return response(['code' => 200, 'message' => '保存成功']);
    }

    /**
     * 删除仓库
     */
    public function deleteWareHouse($id) {
        $warehouse = Warehouses::find($id);
        if (!$warehouse) {
            return response(['code' => 501, 'message' => '不存在的仓库']);
        }
        $warehouse->delete();
        clog('删除', $warehouse, '删除仓库');
        return response(['code' => 200, 'message' => '删除成功']);
    }

    /**
     * 获取单位
     */
    public function getCompany() {
        $listQuery = request(['kw', 'page', 'limit']);
        $kw = trim($listQuery['kw']) ? '%' . trim($listQuery['kw']) . '%' : '';
        $page = intval($listQuery['page']);
        $limit = intval($listQuery['limit']);

        $list = Company::when($kw, function ($query) use ($kw) {
            $query->where('name', 'like', $kw);
        });
        $total = $list->count();
        $list = $list->offset(($page - 1) * $limit)->limit($limit)->get();

        foreach ($list as &$item) {
            $item->typeName = $this->companyType[$item->type];
        }

        return response(['code' => 200, 'message' => 'success', 'data' => $list, 'total' => $total]);
    }

    /**
     * 保存单位
     */
    public function saveCompany() {
        $form = request(['id', 'name', 'type', 'address', 'contact', 'tel', 'license']);
        if (!trim($form['name'])) {
            return response(['code' => 501, 'message' => '请输入正确的公司名称']);
        }
        if ($form['id']) {
            $company = Company::find($form['id']);
        } else {
            $company = new Company();
        }
        $company->name = trim($form['name']);
        $company->type = intval($form['type']);
        $company->contact = trim($form['contact']);
        $company->tel = trim($form['tel']);
        $company->license = trim($form['license']);
        $company->address = trim($form['address']);
        $company->save();

        if ($form['id']) 
            clog('修改', $company, '修改往来单位');
        else
            clog('新增', $company, '新增往来单位');

        return response(['code' => 200, 'message' => '保存成功']);
    }

    /**
     * 删除单位
     */
    public function deleteCompany($id) {
        $company = Company::find($id);
        if (!$company) {
            return response(['code' => 501, 'message' => '不存在的单位']);
        }
        clog('删除', $company, '删除往来单位');
        $company->delete();
        return response(['code' => 200, 'message' => '删除成功']);
    }
}
