<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller
{
    public function addCartAjax(Request $request)
    {
        $data = $request->all();
        $product = Product::find($data['cart_product_id']);

        $cart['id'] = $data['cart_product_id'];
        $cart['qty'] = $data['cart_product_qty'];
        $cart['name'] = $product->name_product;
        $cart['price'] = $data['cart_product_price'];
        $cart['weight'] =  '';
        $cart['options']['image'] = $product->img_product;
        $cart['options']['stock2_product'] = $product->stock2_product;
        Cart::add($cart);
    }
    public function saveCart(Request $request)
    {
        $id_p = $request->id_pd;
        $qty = $request->qty;
        $price = $request->price;

        $product = Product::find($id_p);

        $data['id'] = $id_p;
        $data['qty'] = $qty;
        $data['name'] = $product->name_product;
        $data['price'] = $price;
        $data['weight'] =  '';
        $data['options']['image'] = $product->img_product;

        Cart::add($data);

        return Redirect::to('cart');

        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';

    }

    public function delItemCart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/cart');
    }

    public function updateItemCart(Request $request)
    {
        $rowId = $request->rowId;
        $cart['qty'] = $request->item_qty;

        Cart::update($rowId, $cart['qty']);
    }

    public function showCart(Request $request)
    {
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Giỏ hàng ";
        $meta_keywords = "Giỏ hàng, cart";
        $meta_title = "Cart | E-Shopper";
        $url_canonical = $request->url();
        //seo     

        return view('pages.cart.cart')->with('category', $category)->with('type', $type)
            ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner'));
    }
}
