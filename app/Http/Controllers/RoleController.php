<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Role;
use App\Models\AdminRole;
use PhpParser\Node\Expr\FuncCall;

class RoleController extends Controller
{
    public function AuthLogin()
    {
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function showAddRole()
    {
        $this->AuthLogin();
        return view('admins.role.addRole');
    }
    public function showAllRole()
    {
        $this->AuthLogin();
        $admin = Admin::with('role')->orderByDesc('id_admin')->paginate(10);
        $role = Role::where('status_role', 0)->get();
        return view('admins.role.allRole')->with(compact('admin', 'role'));
    }
    public function showEditRole($id)
    {
        $this->AuthLogin();
        $role = Role::find($id);
        return view('admins.role.updateRole')->with(compact('role'));
    }
    public function addRole(Request $request)
    {
        $data = $request->all();
        $role = new Role();

        if (isset($data['name_role']) && $data['name_role'] != '') {
            $Role = Role::all();
            $count = 0;
            foreach ($Role as $r) {
                if ($r->name_role == $data['name_role']) {
                    $count++;
                    Session::put('warning', 'Quyền truy cập đã tồn tại.');
                    return Redirect::to('/admin/show-add-role');
                    break;
                }
            }
            if ($count == 0) {
                $role['name_role'] = $data['name_role'];
                $role['description_role'] = $data['description_role'];
                $role['status_role'] = $data['status_role'];
                $role->save();
                Session::put('message', 'Thêm Quyền truy cập thành công.');
                return Redirect::to('/admin/show-add-role');
            }
        } else {
            Session::put('warning', 'Vui lòng nhập đủ thông tin vào các mục được yêu cầu.');
            return Redirect::to('/admin/show-add-role');
        }
    }
    public function roleAdmin(Request $request)
    {
        $data = $request->all();
        $admin = Admin::where('email_admin', $data['email_admin'])->first();
        $admin->role()->detach();
        $role = Role::where('status_role', 0)->get();
        foreach ($role as $r) {
            if (isset($data[$r->name_role])) {
                $admin->role()->attach(Role::where('name_role', $r->name_role)->first());
            }
        }
        $admin_role = AdminRole::where('admin_id_admin', $admin->id_admin)->get(); 
        $count = 0;
        foreach($admin_role as $ar) {
            $count ++;
        }
        if ($count != 0) {
            return Redirect::to('/admin/show-all-role');
        }
        else {
            $admin->role()->attach(Role::where('name_role', 'User')->first());
            Session::put('warning', 'Mỗi tài khoản phỉa được cấp ít nhất một quyền truy cập.');
            return Redirect::to('/admin/show-all-role');
        }
        
    }
}
