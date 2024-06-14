<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Sort;

class CategoryProductController extends Controller
{
    public function AuthLogin()
    {
        //kiểm tra đã đăng nhập trước khi truy cập các trang liên quan đến admin
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function showCategoryProduct()
    {
        // echo 'liệt kê danh mục sản phẩm';
        $this->AuthLogin();
        $category = Category::with('brand')->get();
        // echo '<pre>';
        // print_r($category);
        // echo '</pre>';
        $manager_category = view('admins.category.allCategoryProduct')->with('all_category', $category);
        return view('homeA')->with('admins.category.allCategoryProduct', $manager_category);
    }

    public function showAddCategory()
    {
        // echo 'trang thêm danh mục sản phẩm';
        $this->AuthLogin();

        // $brand = DB::table('brand')->where('status_brand', '0')->get();
        $brand = Brand::where('status_brand', '0')->get();
        $manager_brand = view('admins.category.addCategoryProduct')->with(compact('brand'));
        return view('homeA')->with('admins.category.addCategoryProduct', $manager_brand);
    }

    public function addCategory(Request $request)
    {
        //thêm danh mục mới
        // $data = array();

        // $data['name_category'] = $request->name_category;
        // $data['description_category'] = $request->description_category;
        // // $data['img_category'] = $request->img_category;
        // $data['status_category'] = $request->status_category;
        // $data['id_brand'] = $request->type_category;
        //$get_img = $request->file('img_category');
        // if ($get_img) {
        //     $get_img_name = $get_img->getClientOriginalName();
        //     $name_img = current(explode('.', $get_img_name));
        //     $new_img = $name_img . rand(0, 99) . '.' . $get_img->getClientOriginalExtension();
        //     $get_img->move('public/upload/category', $new_img);
        //     $data['img_category'] = $new_img;
        //     DB::table('category_product')->insert($data);
        //     Session::put('message', 'Thêm danh mục sản phẩm thành công.');

        //     return Redirect::to('/admin/show-add-category-product');
        // } else {
        //     $data['img_category'] = '';
        //     DB::table('category_product')->insert($data);
        //     Session::put('message', 'Thêm danh mục sản phẩm thành công.');

        //     return Redirect::to('/admin/show-add-category-product');
        // }

        $data = $request->all();

        $category = new Category();
        $category['name_category'] = $data['name_category'];
        $category['description_category'] = $data['description_category'];
        $category['status_category'] = $data['status_category'];
        $category['id_brand'] = $data['type_category'];
        $category['key_category'] = $data['key_category'];
        if ($data['slug_category'] == '') {
            $category->slug_category = $this->link_slug($data['name_category']);
        } else {
            $category->slug_category = $this->link_slug($data['slug_category']);
        }

        if ($data['img_category']) {
            $get_img_name = $data['img_category']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_category']->getClientOriginalExtension();
            $data['img_category']->move('public/upload/category', $new_img);
            $data['img_category'] = $new_img;

            $category['img_category'] = $data['img_category'];
            $category->save();

            Session::put('message', 'Thêm danh mục sản phẩm thành công.');
            return Redirect::to('/admin/show-add-category-product');
        } else {
            $category['img_category'] = '';
            $category->save();

            Session::put('message', 'Thêm danh mục sản phẩm thành công.');
            return Redirect::to('/admin/show-add-category-product');
        }

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        // echo '<pre>';
        // print_r($get_img);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($get_img);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

    }

    public function showUpdateCategoryProduct($id)
    {
        //cập nhật và xem chi tiết danh mục đã có
        $this->AuthLogin();
        // $category = DB::table('category_product')
        //     ->join('brand', 'category_product.id_brand', '=', 'brand.id_brand')
        //     ->select('category_product.*', 'brand.name_brand', 'brand.id_brand')
        //     ->where('id_category', $id)->get();
        $category = Category::where('id_category', $id)->with('brand')->get();
        $brand = Brand::where('status_brand', '0')->get();
        $manager_category = view('admins.category.updateCategoryProduct')->with('edit_category', $category)->with('brand', $brand);
        return view('homeA')->with('admins.category.updateCategoryProduct', $manager_category);
    }

    public function updateCategory(Request $request, $id)
    {
        //cập nhật danh mục
        $data = $request->all();
        $category = Category::find($id);

        if (isset($data['name_category'])) {
            $category['name_category'] = $data['name_category'];
        }
        if (isset($data['description_category'])) {
            $category['description_category'] = $data['description_category'];
        }
        if (isset($data['slug_category'])) {
            $category['slug_category'] = $this->link_slug($data['slug_category']);
        }
        if (isset($data['key_category'])) {
            $category['key_category'] = $data['key_category'];
        }
        $category['status_category'] = $data['status_category'];
        $category['id_brand'] = $data['id_brand'];
        
        if (isset($data['img_category'])) {
            $get_img_name = $data['img_category']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_category']->getClientOriginalExtension();
            $data['img_category']->move('public/upload/category', $new_img);
            $data['img_category'] = $new_img;
            $category->save();
            Session::put('message', 'Cập nhật danh mục sản phẩm thành công.');

            return Redirect::to('/admin/edit-category-product/' . $id);
        } 
        else {
            $category->save();
            Session::put('message', 'Cập nhật danh mục sản phẩm thành công.');
            return Redirect::to('/admin/edit-category-product/' . $id);
        }

        // echo '<pre>';
        // print_r($get_img_name);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($get_img);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
    }

    public function delCategoryProduct($id)
    {
        DB::table('category_product')->where('id_category', $id)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công.');

        return Redirect::to('/admin/all-category-product');
    }

    //=====END FUNCTION ADMIN PAGE=====

    public function showCategoryID(Request $request, $slug)
    {
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $id = Category::where('slug_category', $slug)->first();
        $product = Product::where('status_product', '=', 0)->where('id_category', $id->id_category);
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        $sort = Sort::where('status_sort', 0)->where('id_brand', $id->id_brand)->get();

        $min_price = $this->roundDown(Product::where('id_brand', $id->id_brand)->min('price_product'));        
        $max_price = $this->roundUp(Product::where('id_brand', $id->id_brand)->max('price_product'));

        //Seo
            $name = $id->name_category;
            $meta_desc = "Web demo cửa hàng bán điện thoại - Loại sản phẩm " . $name;
            $meta_keywords = $name;
            $meta_title = $name . " | E-Shopper";
            $url_canonical = $request->url();
        //seo

        if (isset($_GET['available'])) {
            $product->where('stock2_product', '>', 0);
        }

        if (isset($_GET['type'])) {
            $sort_type = $_GET['type'];
            foreach ($type as $b) {
                if ($b->parent_brand != 0) {
                    if ($sort_type == $b->slug_brand) {
                        $product->where('type_brand_product', $b->id_brand);
                    }
                }
            }
        }

        if (isset($_GET['money_sort'])) {
            $money = $_GET['money_sort'];
            $sort_money = Sort::where('href_sort', $money)->first();
            if($sort_money->to_sort == -1) {$product->where('price_product', '>', $sort_money->from_sort)->get();}
            else {$product->whereBetween('price_product', [$sort_money->from_sort, $sort_money->to_sort])->get();}
            
        }

        if (isset($_GET['price_start']) && isset($_GET['price_end'])) {
            $from = (int) str_replace("đ", "", str_replace(",", "", $_GET['price_start']));
            $to = (int) str_replace("đ", "", str_replace(",", "", $_GET['price_end']));
            $product->whereBetween('price_product', [$from, $to])->get();            
        }

        if (isset($_GET['sort_by'])) {
            $sort_by =  $_GET['sort_by'];
            switch ($sort_by) {
                case 'new':
                    $product->orderByDesc('release_product');
                    break;
                case 'hot':
                    $product
                        ->orderByDesc('sold_product')->orderByDesc('release_product');
                    break;
                case 'desc':
                    $product->orderByDesc('price_product');
                    break;
                case 'asc':
                    $product->orderby('price_product', 'asc');
                    break;
                case 'sale':
                    $product->orderByDesc('sale_product');
                    break;
                case 'za':
                    $product->orderByDesc('name_product');
                    break;
                case 'az':
                    $product->orderby('name_product', 'asc');
                    break;
                default:
                    $product->orderByDesc('release_product');
                    break;
            }
        }

        $product = $product->paginate(9)->appends(request()->query());
        return view('pages.category.category')->with('category', $category)
            ->with('type', $type)->with('product', $product)->with('nameC', $id)
            ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner', 'sort', 'min_price', 'max_price'));
    }

    //=====END FUNCTION CLIENT PAGE=====
}
