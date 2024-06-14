<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Banner;
use App\Models\Client;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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

    public function showProduct()
    {
        // echo 'liệt kê sản phẩm';
        $this->AuthLogin();
        $product = Product::orderByDesc('id_product')->with('category')->get();
        // $product = DB::table('product')
        //     ->join('category_product', 'product.id_category', '=', 'category_product.id_category')
        //     ->select('product.*', 'category_product.name_category')
        //     ->orderBy('id_product', 'desc')
        //     ->get();
        // echo '<pre>';
        // print_r($product);
        // echo '</pre>';
        $manager_product = view('admins.product.allProduct')->with('all_product', $product);
        return view('homeA')->with('admins.product.allProduct', $manager_product);
    }

    public function showTypeProduct()
    {
        $this->AuthLogin();
        $brand = Brand::all();
        $manager_brand = view('admins.product.addTypeProduct')->with('brand', $brand);
        return view('homeA')->with('admins.product.addTypeProduct', $manager_brand);
    }

    public function showAddProduct($id)
    {
        $this->AuthLogin();
        $category = Category::where('id_brand', $id)->get();
        $parent = Brand::where('parent_brand', $id)->get();
        $id_brand = $id;
        // echo '<pre>';
        // print_r($category);
        // echo '</pre>';
        $manager_category = view('admins.product.addProduct')->with(compact('category', 'parent'))
            ->with('brand', $id_brand);
        return view('homeA')->with('admins.product.addProduct', $manager_category);
    }

    public function addProduct(Request $request)
    {
        //thêm sản phẩm mới
        $data = $request->all();
        $price = filter_var($data['price_product'], FILTER_SANITIZE_NUMBER_INT);
        $product = new Product();

        $product['name_product'] = $data['name_product'];
        if ($data['slug_post'] == '') {
            $product->slug_product = $this->link_slug($data['name_product']);
        } else {
            $product->slug_product = $this->link_slug($data['slug_product']);
        }
        $product['description_product'] = $data['description_product'];
        $product['info_product'] = $data['info_product'];
        $product['status_product'] = $data['status_product'];
        $product['priceOld_product'] = $price;
        $product['priceOrigin_product'] = str_replace(",", "", $data['priceOrigin_product']);
        $product['price_product'] = $this->priceSaleProduct($price, $data['sale_product']);
        $product['sale_product'] = $data['sale_product'];
        $product['stock_product'] = $data['stock_product'];
        $product['stock2_product'] = $product['stock_product'];
        $product['sold_product'] = 0;
        $product['id_category'] = $data['id_category'];
        $product['id_brand'] = $data['id_brand'];
        $product['release_product'] = $data['release_product'];
        $product['type_brand_product'] = $data['type_product'];
        if (isset($data['img_product'])) {
            $get_img_name = $data['img_product']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_product']->getClientOriginalExtension();
            $data['img_product']->move('public/upload/product', $new_img);
            $product['img_product'] = $new_img;
            $product->save();
            Session::put('message', 'Thêm sản phẩm thành công.');
            return Redirect::to('/admin/show-add-product/' . $data['id_brand']);
        } else {
            $product['img_product'] = '';
            $product->save();
            Session::put('message', 'Thêm sản phẩm thành công.');

            return Redirect::to('/admin/show-add-product/' . $data['id_brand']);
        }
        // echo '<pre>';
        // print_r($get_img);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
    }

    public function showUpdateProduct($id)
    {
        //cập nhật và xem chi tiết Sản phẩm đã có
        $this->AuthLogin();

        // $product = DB::table('product')
        //     ->join('category_product', 'product.id_category', '=', 'category_product.id_category')
        //     ->join('brand', 'category_product.id_brand', '=', 'brand.id_brand')
        //     ->select('product.*', 'category_product.name_category', 'brand.name_brand')
        //     ->where('id_product', $id)->get();

        // $category = DB::table('category_product')->select('id_category', 'name_category')->get();

        $product = Product::where('id_product', $id)->with(['category', 'brand'])->first();
        $category = Category::select('id_category', 'name_category')->get();
        $brand = Brand::where('id_brand', $product->type_brand_product)->first();
        $parent = Brand::where('parent_brand', $product->id_brand)->get();
        $gallery = Gallery::where('id_product', $id)->where('status_gallery', 0)->get();
        // echo '<pre>';
        // print_r($category);
        // echo '</pre>';
        $manager_product = view('admins.product.updateProduct')->with(compact('category', 'product', 'brand', 'parent', 'gallery'));
        return view('homeA')->with('admins.product.updateProduct', $manager_product);
    }

    public function updateProduct(Request $request, $id)
    {
        //cập nhật Sản phẩm
        $data = $request->all();
        $product = Product::find($id);

        if (isset($data['name_product'])) {
            $product['name_product'] = $data['name_product'];
        }
        if (isset($data['description_product'])) {
            $product['description_product'] = $data['description_product'];
        }
        if (isset($data['info_product'])) {
            $product['info_product'] = $data['info_product'];
        }
        if (isset($data['priceOld_product'])) {
            $priceOld = str_replace(",", "", $data['price_product']);
            $product['priceOld_product'] = $priceOld;
            $product['price_product'] = $this->priceSaleProduct($priceOld, $data['sale_product']);
        }
        if (isset($data['priceOrigin_product'])) {
            $priceOrigin = str_replace(",", "", $data['priceOrigin_product']);
            $product['priceOrigin_product'] = $priceOrigin;
        }
        if (isset($data['sale_product'])) {
            $product['sale_product'] = $data['sale_product'];
        }
        if (isset($data['stock_product'])) {
            $product['stock_product'] = $data['stock_product'];
        }
        if (isset($data['release_product'])) {
            $product['release_product'] = $data['release_product'];
        }
        if (isset($data['slug_product'])) {
            $product->slug_product = $this->link_slug($data['slug_product']);
        }
        $product['status_product'] = $data['status_product'];
        $product['id_category'] = $data['id_category'];

        if (isset($data['img_product'])) {
            $get_img_name = $data['img_product']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_product']->getClientOriginalExtension();
            $data['img_product']->move('public/upload/product', $new_img);
            $product['img_product'] = $new_img;
            $product->save();
            Session::put('message', 'Cập nhật Sản phẩm sản phẩm thành công.');

            return Redirect::to('/admin/show-edit-product/' . $id);
        } else {
            $product->save();
            Session::put('message', 'Cập nhật Sản phẩm sản phẩm thành công.');

            return Redirect::to('/admin/show-edit-product/' . $id);
        }
        // echo '<pre>';
        // print_r($get_img);
        // echo '</pre>';
    }

    public function delProduct($id)
    {
        // DB::table('product')->where('id_product', $id)->delete();
        Product::find($id)->delete();
        Session::put('message', 'Xóa Sản phẩm thành công.');

        return Redirect::to('/admin/all-product');
    }

    public function showAddGallery($id)
    {
        $this->AuthLogin();
        $id_product = $id;
        $product = Product::find($id);
        $gallery = Gallery::where('id_product', $id)->get();
        $manager = view('admins.product.addGallery')->with(compact('id_product', 'product', 'gallery'));
        return view('homeA')->with('admins.product.addGallery', $manager);
    }
    public function showUpdateGallery($id)
    {
        $this->AuthLogin();
        $gallery = Gallery::where('id_gallery', $id)->with('product')->first();
        $manager = view('admins.product.updateGallery')->with(compact('gallery'));
        return view('homeA')->with('admins.product.updateGallery', $manager);
    }
    public function addGallery(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        //print_r($data['img_gallery']);
        $gallery = new Gallery();
        if (isset($data['name_gallery']) && isset($data['img_gallery']) && isset($data['status_gallery'])) {
            $gallery->name_gallery = $data['name_gallery'];
            $gallery->status_gallery = $data['status_gallery'];
            $gallery->id_product = $data['id_product'];

            $get_img_name = $data['img_gallery']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_gallery']->getClientOriginalExtension();
            $data['img_gallery']->move('public/upload/gallery', $new_img);
            $gallery['img_gallery'] = $new_img;

            $gallery->save();
            Session::put('message', 'Thêm hình ảnh thành công.');
            return Redirect::to('/admin/show-add-gallery/' . $data['id_product']);
        } else {
            Session::put('warning', 'Yêu cầu nhập đủ tất cả thông tin!');
            return Redirect::to('/admin/show-add-gallery/' . $data['id_product']);
        }
    }
    public function updateGallery(Request $request, $id)
    {
        $this->AuthLogin();
        $data = $request->all();
        //print_r($data['img_gallery']);
        $gallery = Gallery::find($id);
        if (isset($data['name_gallery'])) {
            $gallery->name_gallery = $data['name_gallery'];
        }
        $gallery->status_gallery = $data['status_gallery'];
        if (isset($data['img_gallery'])) {
            unlink('public/upload/gallery/' . $gallery->img_gallery); // delete img old
            $get_img_name = $data['img_gallery']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_gallery']->getClientOriginalExtension();
            $data['img_gallery']->move('public/upload/gallery', $new_img);
            $gallery['img_gallery'] = $new_img;
        }

        $gallery->save();
        Session::put('message', 'Cập nhật hình ảnh (mã ' . $id . ') thành công.');
        return Redirect::to('/admin/show-add-gallery/' . $gallery->id_product);
    }
    public function delGallery($id)
    {
        $g = Gallery::find($id);
        unlink('public/upload/gallery/' . $g->img_gallery);
        $g->delete();
        Session::put('message', 'Xóa hình ảnh thành công.');

        return Redirect::to('/admin/show-add-gallery/' . $g->id_product);
    }

    //=====END FUNCTION ADMIN PAGE=====

    public function showProductID(Request $request, $slug)
    {
        // $category = DB::table('category_product')->where('status_category', 0)->orderByDesc('id_category')->get();
        // $type = DB::table('brand')->where('status_brand', 0)->get();
        // $product = DB::table('product')
        //     ->join('category_product', 'product.id_category', '=', 'category_product.id_category')
        //     ->join('brand', 'category_product.id_brand', '=', 'brand.id_brand')
        //     ->select('product.*', 'category_product.name_category', 'brand.name_brand')
        //     ->where('status_product', '=', 0)->where('product.id_product', $id)->get();

        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        $product = Product::where('slug_product', $slug)
            ->with(['category', 'brand'])->first();
        $gallery = Gallery::where('id_product', $product->id_product)->where('status_gallery', 0)->get();

        $comment = Comment::where('id_product', $product->id_product)->where('status_comment', 0)->get();
        $count = $comment->count();

        $product->view_product = $product->view_product + 1;
        $product->save();

        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Loại sản phẩm " . $product->name_product;
        $meta_keywords = $product->name_product;
        $meta_title = $product->name_product . " | E-Shopper";
        $url_canonical = $request->url();
        //seo

        $relate_product = Product::with('category')
            ->where('status_product', '=', 0)
            ->where('product.id_category', $product->id_category)
            ->whereNotIn('product.id_product', [$product->id_product])
            ->orderBy('product.release_product', 'desc')->get();

        return view('pages.product.product')->with('category', $category)->with('type', $type)
            ->with('product', $product)->with('relate_product', $relate_product)
            ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner', 'gallery', 'comment', 'count'));
    }

    //=====END FUNCTION CLIENT PAGE=====
}
