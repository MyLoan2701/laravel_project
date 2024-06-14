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
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\tinhthanhpho;
use App\Models\quanhuyen;
use App\Models\xaphuongthitran;
// session_start();

class AdminController extends Controller
{
    public function AuthLogin()
    {
        //$id = Session::get('id_admin');
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function index()
    {
        // $this->AuthLogin();
        return view('loginA');
    }

    public function showHomeAdmin()
    {
        $this->AuthLogin();
        $brand = Brand::count();
        $category = Category::count();
        $product = Product::count();
        $coupon = Coupon::count();
        $order = Order::count();
        $comment = Comment::count();
        $contact = Contact::count();
        $banner = Banner::count();
        $post = Post::count();
        $view_post = Post::orderBy('view_post', 'desc')->take(20)->get();
        $view_product = Product::orderBy('view_product', 'desc')->take(20)->get();
        return view('admins.dashboard')->with(compact('product', 'brand', 'category', 'banner', 'coupon', 
        'order', 'post', 'comment', 'contact', 'view_post', 'view_product'));
    }

    //--Đăng nhập admin bằng session
    // public function checkLoginAdmin(Request $request)
    // {
    //     $email = $request->email_admin;
    //     $pwd = md5($request->pwd_admin);

    //     $result = DB::table('admin')->where('email_admin', $email)->where('password_admin', $pwd)->first();

    //     if ($result) {
    //         Session::put('name_admin', $result->name_admin);
    //         Session::put('id_admin', $result->id_admin);
    //         return Redirect::to('/admin/home');
    //     } else {
    //         Session::put('message', 'Tài khoản hoặc mật khẩu bạn nhập không đúng, vui lòng nhập lại!');
    //         return Redirect::to('/admin');
    //     }
    // }

    //--Đăng nhập Admin bằng Auth
    public function checkLoginAdmin(Request $request)
    {
        if ($request->email_admin == '' || $request->pwd_admin == '') {
            Session::put('message', 'Vui lòng nhập đủ Email và Mật khẩu.');
            return Redirect::to('/admin');
        } else {
            $email = $request->email_admin;
            $pwd = md5($request->pwd_admin);

            if (Auth::attempt(['email_admin' => $email, 'password_admin' => $pwd])) {
                return Redirect::to('/admin/home');
            } else {
                Session::put('message', 'Tài khoản hoặc mật khẩu bạn nhập không đúng, vui lòng nhập lại!');
                return Redirect::to('/admin');
            }
        }
    }

    public function logout(Request $request)
    {
        $this->AuthLogin();
        // Session::put('name_admin', null);
        // Session::put('id_admin', null);
        Auth::logout();
        return Redirect::to('/admin');
    }

    public function showAddAdmin()
    {
        $this->AuthLogin();
        $role = Role::where('status_role', 0)->get();
        $city = tinhthanhpho::all();
        $province = quanhuyen::orderby('id_qh', 'asc')->get();
        $wards = xaphuongthitran::orderby('id_xp', 'asc')->get();
        return view('admins.admin.addAdmin')->with(compact('role', 'city', 'province', 'wards'));
    }
    public function showAllAdmin()
    {
        $this->AuthLogin();
        $admin = Admin::all();
        $role = Role::where('status_role', 0)->get();
        return view('admins.admin.allAdmin')->with(compact('admin', 'role'));
    }
    public function showEditAdmin($id)
    {
        $this->AuthLogin();
        $admin = Admin::find($id);
        $city = tinhthanhpho::all();
        $province = quanhuyen::orderby('id_qh', 'asc')->get();
        $wards = xaphuongthitran::orderby('id_xp', 'asc')->get();
        return view('admins.admin.updateAdmin')->with(compact('admin', 'city', 'province', 'wards'));;
    }

    public function validation($request)
    {
        return $this->validate($request, [
            'name_admin' => 'required|max:255',
            'email_admin' => 'required|max:255',
            'password_admin' => 'required|max:255',
            'phone_admin' => 'required|max:255',
            'city' => 'required|max:255',
            'province' => 'required|max:255',
            'address_admin' => 'required|max:255',
            'home_admin' => 'required|max:255',
            'birth_admin' => 'required|max:255',
        ]);
    }
    public function addAdmin(Request $request)
    {
        $this->validation($request);
        $data = $request->all();
        $admin = new Admin();
        $admin_role = Role::where('name_role', 'User')->first();
        $city = tinhthanhpho::where('id_tp', $data['city'])->select('name_tp')->first();
        $province = quanhuyen::where('id_qh', $data['province'])->select('name_qh')->first();
        $wards = xaphuongthitran::where('id_xp', $data['wards'])->select('name_xp')->first();

        if (
            isset($data['name_admin']) && isset($data['email_admin'])
            && isset($data['password_admin']) && isset($data['phone_admin'])
            && isset($data['address_admin']) && isset($data['birth_admin'])
            && isset($data['home_admin'])
        ) {
            $admins = Admin::all();
            $count = 0;
            foreach ($admins as $ad) {
                if ($ad->email_admin == $data['email_admin']) {
                    $count++;
                    Session::put('warning', 'Email đã được đăng ký sử dụng, vui lòng nhập email khác.');
                    return Redirect::to('/admin/show-add-admin');
                    break;
                }
            }
            if ($count == 0) {
                $count_pwd = strlen($data['password_admin']);
                if ($count_pwd < 6) {
                    Session::put('warning', 'Mật khẩu phải chứa ít nhất 6 ký!');
                    return Redirect::to('/admin/show-add-admin');
                } else {
                    $admin['name_admin'] = $data['name_admin'];
                    $admin['email_admin'] = $data['email_admin'];
                    $admin['password_admin'] = md5($data['password_admin']);
                    $admin['phone_admin'] = $data['phone_admin'];
                    $admin['address_admin'] = $data['address_admin'] . ", " . $wards->name_xp . ", " . $province->name_qh . ", " . $city->name_tp;
                    $admin['hometown_admin'] = $data['home_admin'];
                    $admin['sex_admin'] = $data['sex_admin'];
                    $admin['status_admin'] = $data['status_admin'];
                    $admin['birth_admin'] = $data['birth_admin'];
                    if (isset($data['img_admin'])) {
                        $get_img_name = $data['img_admin']->getClientOriginalName();
                        $name_img = current(explode('.', $get_img_name));
                        $new_img = $name_img . rand(0, 99) . '.' . $data['img_admin']->getClientOriginalExtension();
                        $data['img_admin']->move('public/upload/admin', $new_img);
                        $data['img_admin'] = $new_img;

                        $admin['avatar_admin'] = $data['img_admin'];
                        $admin->save();
                    } else {
                        $admin['avatar_admin'] = '';
                        $admin->save();
                    }
                    $admin->role()->attach($admin_role);
                    Session::put('message', 'Bạn đã đăng ký tài khoản admin thành công!');
                    return Redirect::to('/admin/show-add-admin');
                }
            }
        } else {
            Session::put('warning', 'Vui lòng nhập đủ thông tin vào các mục được yêu cầu.');
            return Redirect::to('/admin/show-add-admin');
        }
    }

    public function updateAdmin(Request $request, $id)
    {
        $data = $request->all();
        $admin = Admin::find($id);


        if (isset($data['name_admin'])) {
            $admin['name_admin'] = $data['name_admin'];
        }
        if (isset($data['phone_admin'])) {
            $admin['phone_admin'] = $data['phone_admin'];
        }
        if (isset($data['home_admin'])) {
            $admin['hometown_admin'] = $data['home_admin'];
        }
        if (isset($data['birth_admin'])) {
            $admin['birth_admin'] = $data['birth_admin'];
        }
        if (isset($data['name_admin'])) {
            $admin['name_admin'] = $data['name_admin'];
        }
        if (isset($data['password_admin'])) {
            if (strlen($data['password_admin'] < 6)) {
                Session::put('warning', 'Mật khẩu phải chứa ít nhất 6 ký!');
                return Redirect::to('/admin/show-edit-admin/' . $id);
            } else $admin['password_admin'] = md5($data['password_admin']);
        }
        if (isset($data['address_admin'])) {
            if (isset($data['city']) && isset($data['province'])) {
                $city = tinhthanhpho::where('id_tp', $data['city'])->select('name_tp')->first();
                $province = quanhuyen::where('id_qh', $data['province'])->select('name_qh')->first();
                $wards = xaphuongthitran::where('id_xp', $data['wards'])->select('name_xp')->first();
                $admin['address_admin'] = $data['address_admin'] . ", " . $wards->name_xp . ", " . $province->name_qh . ", " . $city->name_tp;
            } else {
                Session::put('warning', 'Nếu bạn muốn Thay đổi Địa chỉ thì vui lòng nhập đủ thông tin liên quan đến mục (Địa chỉ)');
                return Redirect::to('/admin/show-edit-admin/' . $id);
            }
        }
        if (isset($data['img_admin'])) {
            $get_img_name = $data['img_admin']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_admin']->getClientOriginalExtension();
            $data['img_admin']->move('public/upload/admin', $new_img);
            $data['img_admin'] = $new_img;

            $admin['avatar_admin'] = $data['img_admin'];
        }
        $admin['sex_admin'] = $data['sex_admin'];
        $admin['status_admin'] = $data['status_admin'];
        $admin->save();

        Session::put('message', 'Bạn đã cập nhật tài khoản admin thành công!');
        return Redirect::to('/admin/show-edit-admin/' . $id);
    }
    public function delAdmin($id)
    {
        $admin = Admin::find($id);
        $admin->role()->detach();
        // $role_admin = AdminRole::where('admin_id_admin', $id);
        // $role_admin->delete();
        $admin->delete();
        Session::put('message', 'Xóa tài khoản admin thành công.');

        return Redirect::to('/admin/show-all-admin');
    }
}
