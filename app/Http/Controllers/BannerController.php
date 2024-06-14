<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function AuthLogin() {
        //kiểm tra đã đăng nhập trước khi truy cập các trang liên quan đến admin
        //$id = Session::get('id_admin');
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        }
        else {
            return Redirect::to('/admin')->send();
        }
    }
    public function showAddBanner() {
        $this->AuthLogin();
        return view('admins.banner.addBanner');
    }
    public function addBanner(Request $request) {
        $data = $request->all();
        $banner = new Banner();
        $banner['name_banner'] = $data['name_banner'];
        $banner['status_banner'] = $data['status_banner'];
        $banner['description_banner'] = $data['description_banner'];
        if ($data['img_banner']) {
            $get_img_name = $data['img_banner']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_banner']->getClientOriginalExtension();
            $data['img_banner']->move('public/upload/banner', $new_img);
            $data['img_banner'] = $new_img;

            $banner['img_banner'] = $data['img_banner'];
            $banner->save();

            Session::put('message', 'Thêm banner thành công.');
            return Redirect::to('/admin/show-add-banner');
        } else {
            $banner['img_banner'] = '';
            $banner->save();

            Session::put('message', 'Thêm banner thành công.');
            return Redirect::to('/admin/show-add-banner');
        }
    }
    public function showAllBanner() {
        $this->AuthLogin();
        $banner = Banner::all();
        $manager_banner = view('admins.banner.allBanner')->with('all_banner', $banner);
        return view('homeA')->with('admins.banner.allBanner', $manager_banner);
    }
    public function showEditBanner($id) {
        $this->AuthLogin();
        $banner = Banner::find($id);
        $manager_banner = view('admins.banner.updateBanner')->with('banner', $banner);
        return view('homeA')->with('admins.banner.updateBanner', $manager_banner);
    }
    public function updateBanner(Request $request, $id) {
        $data = $request->all();
        $banner = Banner::find($id);

        $banner['description_banner'] = $data['description_banner'];
        $banner['name_banner'] = $data['name_banner'];
        $banner['status_banner'] = $data['status_banner'];
        
        if (isset($data['img_banner'])) {
            $get_img_name = $data['img_banner']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_banner']->getClientOriginalExtension();
            $data['img_banner']->move('public/upload/banner', $new_img);
            $data['img_banner'] = $new_img;
            $banner->save();
            Session::put('message', 'Cập nhật Banner thành công.');

            return Redirect::to('/admin/show-edit-banner/' . $id);
        } 
        else {
            $banner->save();
            Session::put('message', 'Cập nhật Banner thành công.');
            return Redirect::to('/admin/show-edit-banner/' . $id);
        }
    }
    public function delBanner($id) {
        $banner = Banner::find($id);
        $banner->delete();
        Session::put('message', 'Xóa Banner thành công.');

        return Redirect::to('/admin/show-all-banner');
    }
}
