<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Sort;
use App\Models\Brand;
use Illuminate\Support\Facades\Session;

class SortController extends Controller
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

    public function showAddSort()
    {
        $this->AuthLogin();
        $brand = Brand::where('status_brand', 0)->where('parent_brand', 0)->get();
        return view('admins.sort.addSort')->with(compact('brand'));;
    }
    public function showAllSort()
    {
        $this->AuthLogin();
        $sort = Sort::with('brand')->get();
        return view('admins.sort.allSort')->with(compact('sort'));
    }
    public function showEditSort($id)
    {
        $this->AuthLogin();
        $brand = Brand::where('status_brand', 0)->where('parent_brand', 0)->get();
        $sort = Sort::where('id_sort', $id)->with('brand')->first();
        return view('admins.sort.updateSort')->with(compact('sort', 'brand'));
    }
    public function addSort(Request $request) {
        $this->validate($request, [
            'name_sort' => 'required|max:255',
            'href_sort' => 'required|max:255',
            'from_sort' => 'required|max:255',
            'to_sort' => 'required|max:255',
            'id_brand' => 'required|max:255',
            'status_sort' => 'required|max:255',
        ]);

        $data = $request->all();
        $check = Sort::all();
        $count = 0;
        foreach($check as $c) {
            if ($data['name_sort'] == $c->name_sort && $data['id_brand'] == $c->id_brand) {
                $count ++ ;
                Session::put('warning', 'Tên (lọc) đã tồn tại.');
                return Redirect::to('/admin/show-add-sort');
                break;
            }
        }
        
        if ($count == 0) {
            $sort = new Sort();
    
            $sort->name_sort = $data['name_sort'];
            $sort->href_sort = $this->link_slug($data['href_sort']);
            $sort->description_sort = $data['description_sort'];
            $sort->from_sort = $data['from_sort'];
            $sort->to_sort = $data['to_sort'];
            $sort->id_brand = $data['id_brand'];
            $sort->status_sort = $data['status_sort'];

            $sort->save();
            Session::put('message', 'Thêm thành công.');
            return Redirect::to('/admin/show-add-sort');
        }

    }
    public function updateSort(Request $request, $id) {
        $data = $request->all();
        $check = Sort::all();
        $sort = Sort::find($id);
        $count = 0;
        if ($data['name_sort'] != $sort->name_sort) {
            foreach($check as $c) {
                if ($data['name_sort'] == $c->name_sort && $data['id_brand'] == $c->id_brand) {
                    $count ++ ;
                    Session::put('warning', 'Tên (lọc) đã tồn tại.');
                    return Redirect::to('/admin/show-edit-sort/'.$id);
                    break;
                }
            }
        }
        
        if ($count == 0) {
            if (isset($data['name_sort']) && $data['name_sort'] != '') {
                $sort->name_sort = $data['name_sort'];
            }
            if (isset($data['href_sort']) && $data['href_sort'] != '') {
                $sort->href_sort = $this->link_slug($data['href_sort']);
            }
            if (isset($data['description_sort']) && $data['description_sort'] != '') {
                $sort->description_sort = $data['description_sort'];
            }
            if (isset($data['from_sort']) && $data['from_sort'] != '') {
                $sort->from_sort = $data['from_sort'];
            }
            if (isset($data['to_sort']) && $data['to_sort'] != '') {
                $sort->to_sort = $data['to_sort'];
            }
            $sort->id_brand = $data['id_brand'];
            $sort->status_sort = $data['status_sort'];

            $sort->save();
            Session::put('message', 'Cập nhật thành công.');
            return Redirect::to('/admin/show-edit-sort/'.$id);
        }      
    }
    public function delSort($id) {
        Sort::find($id)->delete();
        Session::put('message', 'Xóa Lọc thành công.');

        return Redirect::to('/admin/show-all-sort');
    }
}
