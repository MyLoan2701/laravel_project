<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Sort;

class BrandController extends Controller
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

    public function showBrand()
    {
        // echo 'liệt kê loại sản phẩm';
        $this->AuthLogin();
        // $brand = DB::table('brand')->get();
        $brand = Brand::all();
        $parent = Brand::where('parent_brand', 0)->get();
        $manager_brand = view('admins.brand.allBrand')->with('all_brand', $brand)->with(compact('parent'));
        return view('homeA')->with('admins.brand.allBrand', $manager_brand);
    }

    public function showAddBrand()
    {
        // echo 'trang thêm loại sản phẩm';
        $this->AuthLogin();
        $brand = Brand::where('parent_brand', 0)->get();
        return view('admins.brand.addBrand')->with(compact('brand'));
    }

    public function addBrand(Request $request)
    {
        //thêm loại mới C1
        // $data = array();

        // $data['name_brand'] = $request->name_brand;
        // $data['description_brand'] = $request->description_brand;
        // $data['status_brand'] = $request->status_brand;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        // DB::table('brand')->insert($data);

        $data = $request->all();
        $brand = new Brand();
        $brand->name_brand = $data['name_brand'];
        $brand->description_brand = $data['description_brand'];
        $brand->status_brand = $data['status_brand'];
        $brand->key_brand = $data['key_brand'];
        $brand->parent_brand = $data['parent_brand'];
        if ($data['slug_brand'] == '') {
            $brand->slug_brand = $this->link_slug($data['name_brand']);
        } else {
            $brand->slug_brand = $this->link_slug($data['slug_brand']);
        }
        $brand->save();

        Session::put('message', 'Thêm loại sản phẩm thành công.');

        return Redirect::to('/admin/show-add-brand');
    }

    public function showUpdateBrand($id)
    {
        //cập nhật và xem chi tiết loại đã có
        $this->AuthLogin();
        // $brand = DB::table('brand')->where('id_brand', $id)->get();
        $brand = Brand::find($id);
        $parent = Brand::where('parent_brand', 0)->get();
        $manager_brand = view('admins.brand.updateBrand')->with(compact('brand', 'parent'));
        return view('homeA')->with('admins.brand.updateBrand', $manager_brand);
    }

    public function updateBrand(Request $request, $id)
    {
        //cập nhật loại
        // $data = array();

        // $data['name_brand'] = $request->name_brand;
        // $data['description_brand'] = $request->description_brand;
        // $data['status_brand'] = $request->status_brand;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        // DB::table('brand')->where('id_brand', $id)->update($data);

        $data = $request->all();
        $brand = Brand::find($id);
        if (isset($data['name_brand'])) {
            $brand['name_brand'] = $data['name_brand'];
        }
        if (isset($data['description_brand'])) {
            $brand['description_brand'] = $data['description_brand'];
        }
        if (isset($data['slug_brand'])) {
            $brand['slug_brand'] = $this->link_slug($data['slug_brand']);
        }
        if (isset($data['key_brand'])) {
            $brand['key_brand'] = $data['key_brand'];
        }
        $brand->status_brand = $data['status_brand'];
        $brand->parent_brand = $data['parent_brand'];
        $brand->save();
        Session::put('message', 'Cập nhật loại sản phẩm thành công.');

        return Redirect::to('/admin/edit-brand/' . $id);
    }

    public function delBrand($id)
    {
        // DB::table('brand')->where('id_brand', $id)->delete();
        $brand = Brand::find($id);
        $brand->delete();
        Session::put('message', 'Xóa loại sản phẩm thành công.');

        return Redirect::to('/admin/all-brand');
    }

    //=====END FUNCTION ADMIN PAGE=====

    public function showBrandID(Request $request, $slug)
    {
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $id = Brand::where('slug_brand', $slug)->first();
        $list_category = Category::where('status_category', 0)->where('id_brand', $id->id_brand)->get();
        $product = Product::where('status_product', 0)->where('id_brand', $id->id_brand);
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        $sort = Sort::where('status_sort', 0)->where('id_brand', $id->id_brand)->get();

        $min_price = $this->roundDown(Product::where('id_brand', $id->id_brand)->min('price_product'));        
        $max_price = $this->roundUp(Product::where('id_brand', $id->id_brand)->max('price_product'));

        $data = $request->all();

        //Seo
        $name = $id->name_brand;
        $meta_desc = "Web demo cửa hàng bán điện thoại - Loại sản phẩm " . $name;
        if ($id->key_brand != '') {
            $meta_keywords = $id->key_brand;
        } else {
            $meta_keywords = $name;
        }
        $meta_title = $name . " | E-Shopper";
        $url_canonical = $request->url();
        //seo

        if (isset($_GET['available'])) {
            $product->where('stock2_product', '>', 0);
        }

        // if (isset($_GET['type'])) {
        //     $queryString = $_SERVER['QUERY_STRING'];
        //     $parts = explode('&', $queryString);
        //     $sort_type = [];
        //     $st = '';
        //     if (count($parts) >= 2) {
        //         for ($i = 0; $i < count($parts); $i++) {
        //             $pair = explode('=', $parts[$i]);
        //             if ($pair[0] == 'type') {
        //                 $sort_type[] = $pair[1];
        //             }
        //         }

        //         for ($i=0; $i < $sort_type; $i++) {
        //             foreach($type as $b){
        //                 if($b->parent_brand != 0) {
        //                     if ($sort_type == $b->slug_brand) {
        //                         ($i == 0) ? $st = $st . $b->id_brand : $st = $st . ',' . $b->id_brand;
        //                     }
        //                 }
        //             }
        //         }
        //         $st = '['.$st.']';
        //         $product->whereIn('type_brand_product', $st);
        //     } else {
        //         $pair = explode('=', $queryString);
        //         foreach ($type as $b) {
        //             if ($b->parent_brand != 0) {
        //                 if ($pair[1] == $b->slug_brand) {
        //                     $product->where('type_brand_product', $b->id_brand);
        //                 }
        //             }
        //         }
        //     }
        // }

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

        return view('pages.brand.brand')->with('category', $category)->with('type', $type)
            ->with('product', $product)->with('nameP', $id)->with('list_c', $list_category)
            ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner', 'sort', 'min_price', 'max_price'));
    }

    public function showBrandID2(Request $request, $slug)
    {
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $id = Brand::where('slug_brand', $slug)->first();
        $list_category = Category::where('status_category', 0)->where('id_brand', $id->parent_brand)->get();
        $product = Product::where('status_product', 0)->where('type_brand_product', $id->id_brand);
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        $sort = Sort::where('status_sort', 0)->where('id_brand', $id->parent_brand)->get();

        $min_price = $this->roundDown(Product::where('id_brand', $id->parent_brand)->min('price_product'));        
        $max_price = $this->roundUp(Product::where('id_brand', $id->parent_brand)->max('price_product'));

        //Seo
        $name = $id->name_brand;
        $meta_desc = "Web demo cửa hàng bán điện thoại - Loại sản phẩm " . $name;
        if ($id->key_brand != '') {
            $meta_keywords = $id->key_brand;
        } else {
            $meta_keywords = $name;
        }
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

        return view('pages.brand.brand')->with('category', $category)->with('type', $type)
            ->with('product', $product)->with('nameP', $id)->with('list_c', $list_category)
            ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner', 'sort', 'min_price', 'max_price'));
    }
    public function tabProduct(Request $request)
    {
        $data = $request->all();
        $tab_product = Product::where('type_brand_product', $data['id'])
            ->where('status_product', 0)->orderby('release_product', 'asc')->take(4)->get();
        $count = $tab_product->count();
        $content = Cart::content();

        $output = '';

        if ($count > 0) {
            $output = '<div class="tab-content">';
            foreach ($tab_product as $tab) {
                $img = "http://localhost:8080/laravel_project/public/upload/product/";
                $product = "http://localhost:8080/laravel_project/product/";

                $output .= '
            <div class="tab-pane fade active in" id="' . $data['slug'] . '">
                <div class="col-sm-3">
                    <div class="product-image-wrapper" style="height:450px;border: 1px solid #e8e8e8;">
                    <a href="' . $product . $tab->slug_product . '" class="link_product" id="wishlist_product_url_' . $tab->id_product . '">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="' . $img . $tab->img_product . '" alt="' . $tab->name_product . '" style="width:100%; height:auto;"
                                id="wishlist_product_img_' . $tab->id_product . '"/>
                                <p class="name-product">' . $tab->name_product . '</p>';
                if ($tab->sale_product > 0) {
                    $output .= '
                                <div class="box-p">
                                    <p class="price-old" id="wishlist_product_price_old_' . $tab->id_product . '">' . number_format($tab->priceOld_product) . '₫</p>
                                    <span class="sale-product" id="wishlist_product_sale_' . $tab->id_product . '">-' . $tab->sale_product . '₫</span>
                                </div>';
                } else {
                    $output .= '
                                <p class="price-old" id="wishlist_product_price_old_' . $tab->id_product . '" style="display:none"></p>
                                <span class="sale-product" id="wishlist_product_sale_' . $tab->id_product . '" style="display:none"></span>
                                ';
                }
                $output .= '
                                <strong class="price">' . number_format($tab->price_product) . '₫</strong>
                            </div>
                        </div>
                    </a>';
                $output .= '
                    <form class="text-center" style="margin-top: 10px;">';
                csrf_field();
                $output .= '
                        <input type="hidden" value="1" name="qty" class="cart-product-qty-' . $tab->id_product . '">
                        <input type="hidden" value="' . $tab->id_product . '" name="id_pd" class="cart-product-id-' . $tab->id_product . '">
                        <input type="hidden" value="' . $tab->price_product . '" name="price" class="cart-product-price-' . $tab->id_product . '">
                        <input type="hidden" value="' . $tab->stock2_product . '"  name="stock" class="cart-product-stock-' . $tab->id_product . '">
                        <input type="hidden" value="' . $tab->name_product . '" name="name" class="wishlist-product-name-' . $tab->id_product . '">';
                if ($content) {
                    foreach ($content as $ct) {
                        if ($ct->id == $tab->id_product) {
                            $output .= '<input type="hidden" name="qty_cart" value="' . $ct->qty . '" class="cart-product-qty-cart-' . $tab->id_product . '">';
                            break;
                        } else {
                            $output .= '<input type="hidden" name="qty_cart" value="" class="cart-product-qty-cart-' . $tab->id_product . '">';
                        }
                    }
                }
                $output .= '
                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" 
                        onclick="addToCart(this.id);" id="' . $tab->id_product . '_add_to_cart">
                            <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                        </button>
                    </form>';
                $output .= '
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified" style="border:none; background-color:white;">
                            <li><i class="fa fa-plus-square"></i>
                                <button class="button-wishlist" id="' . $tab->id_product . '_wishlist" onclick="addWishlist(this.id);">Yêu thích</button>
                            </li>
                            <li><a href="#" style="font-size:11px;"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div>';

                $output .= '
                </div>
            </div>
        </div>';
            }
            $output .= '
    </div>';
        } else {
            $output .= '<div class="tab-content"><div class="col-sm-12 text-center" style="font-style:italic; margin-bottom:30px">
            (Không có sản phẩm nào trong mục này)
            </div></div';
        }

        echo $output;
    }
    //=====END FUNCTION CLIENT PAGE=====
}
