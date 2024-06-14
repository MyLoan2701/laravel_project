<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại";
        $meta_keywords = "phone, điện thoại, di động, laptop, tablets";
        $meta_title = "Home | E-Shopper";
        $url_canonical = $request->url();
        //seo
        
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $product = Product::where('status_product', 0)->orderByDesc('release_product')->take(6)->get();
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        $recommend = Product::where('status_product', 0)->orderBy('sold_product', 'desc')->take(15)->paginate(3);
        return view('pages.home')->with('category', $category)->with('type', $type)->with('product', $product)
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner', 'recommend'));
        // echo '<pre>';
        // print_r($type);
        // echo '</pre>';
    }

    public function show404() {
        return view('errors.404Client');
    }

    public function searchAutocomplete(Request $request) {
        $data = $request->all();
        if ($data['query']) {
            $product = Product::where('name_product', 'LiKE', '%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;">';
            foreach($product as $p) {
                $link = 'http://localhost:8080/laravel_project/product/' . $p->slug_product;
                $img = 'http://localhost:8080/laravel_project/public/upload/product/' . $p->img_product;
                $output .= '<li><a href="'.$link.'" class="link-search-ajax">
                <div>
                <div class="search-img-product">
                <img src="'.$img.'">
                </div>
                <div class="search-info-product">
                <h4>'.$p->name_product.'</h4>
                <strong class="price">'.number_format($p->price_product).'đ</strong>
                <p class="price-old">'.number_format($p->priceOld_product).'đ</p>
                </div>
                </div>
                </a><li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function search(Request $request) {
        $data = $request->all();
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại";
        $meta_keywords = "phone, điện thoại, di động, laptop, tablets";
        $meta_title = "Home | E-Shopper";
        $url_canonical = $request->url();
        //seo
        
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $product = Product::where('name_product', 'LiKE', '%'.$data['keywords'].'%')->get();
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();

        $name = $data['keywords'];
        // $parent = Brand::where('status_brand', 0)->get();
        return view('pages.search')->with('category', $category)->with('type', $type)->with('product', $product)
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner', 'name'));
    }
    public function wishlist(Request $request) {
        $data = $request->all();
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Trang sản phẩm yêu thích";
        $meta_keywords = "phone, điện thoại, di động, laptop, tablets, wishlist, yêu thích, sản phẩm yêu thích";
        $meta_title = "Wishlist | E-Shopper";
        $url_canonical = $request->url();
        //seo
        
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        
        return view('pages.wishlist.wishlist')->with('category', $category)->with('type', $type)
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner'));
    }

}
