<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\tinhthanhpho;
use App\Models\quanhuyen;
use App\Models\xaphuongthitran;
use App\Models\FeeShip;
use App\Models\FeeShip2;
use App\Models\Banner;
use App\Models\Statistic;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redis;

class CheckoutController extends Controller
{
    public function loginCheckout(Request $request)
    {
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Đăng nhập ";
        $meta_keywords = "đăng nhập, đăng ký, login, signup, dang nhap, dang ky";
        $meta_title = "Login | E-Shopper";
        $url_canonical = $request->url();
        //seo
        return view('login')->with('category', $category)->with('type', $type)
            ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner'));
    }

    public function AuthLogin()
    {
        $id = Session::get('id_client');
        if ($id) {
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout')->send();
        }
    }
    public function CheckIdOrder()
    {
        $id = Session::get('id_order');
        if ($id) {
            return Redirect::to('/payment');
        } else {
            return Redirect::to('/cart')->send();
        }
    }

    public function showCheckout(Request $request)
    {
        $this->AuthLogin();
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        $city = tinhthanhpho::all();
        $province = quanhuyen::orderby('id_qh', 'asc')->get();
        $wards = xaphuongthitran::orderby('id_xp', 'asc')->get();
        $fee_city = Session::get('deliveryFee');
        $fee_city2 = Session::get('deliveryFee2');
        if (isset($fee_city)) {
            $fee = FeeShip2::where('id_tp', $fee_city)->first();
        }elseif (isset($fee_city2)) {
            $fee = FeeShip2::where('id_tp', $fee_city2)->first();
        } else $fee = 0;


        $id = Session::get('id_client');
        $client = Client::find($id);
        // echo '<pre>'; print_r($client); echo '</pre>';

        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Thanh toán ";
        $meta_keywords = "cash, bank, thanh toan, checkout, đặt hàng, thanh toán";
        $meta_title = "Checkout | E-Shopper";
        $url_canonical = $request->url();
        //seo
        $cart = Cart::content();
        $count = 0;
        foreach ($cart as $c) {
            $count++;
        }
        if ($count == 0) {
            return Redirect::to('/cart');
        } else {
            return view('pages.checkout.checkout')->with('category', $category)
                ->with('type', $type)->with('client', $client)
                ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'city', 'province', 'wards', 'fee', 'banner'));
        }
    }
    public function addAddress(Request $request)
    {
        $data = $request->all();
        $city = tinhthanhpho::where('id_tp', $data['city'])->select('name_tp')->first();
        $province = quanhuyen::where('id_qh', $data['province'])->select('name_qh')->first();
        $wards = xaphuongthitran::where('id_xp', $data['wards'])->select('name_xp')->first();
        $address = $data['address'] . ", " . $wards->name_xp . ", " . $province->name_qh . ", " . $city->name_tp;
        Session::get('addressOrder');
        Session::put('addressOrder', $address);
        Session::get('deliveryFee');
        Session::put('deliveryFee', $data['city']);
    }
    public function unsetAddress()
    {
        Session::forget('addressOrder');
        Session::forget('deliveryFee');
        return redirect()->back();
    }
    public function saveOrder(Request $request)
    {
        $data = $request->all();
        $coupon = Session::get('coupon');
        $code_order = substr(md5(microtime()), rand(0,26), 5);
        //add-order
        if (isset($data['name']) && isset($data['email']) && isset($data['address']) && isset($data['phone'])) {
            $order = new Order();
            $order['email_order'] = $data['email'];
            $order['name_order'] = $data['name'];
            $order['address_order'] = $data['address'];
            $order['phone_order'] = $data['phone'];
            $order['note_order'] = $data['note'];
            $order['id_payment'] = $data['payment'];
            $order['code_order'] = $code_order;
            $order['fee_delivery_order'] = $data['fee_delivery'];
            $order['id_client'] = Session::get('id_client');
            if ($coupon) {
                $order['code_coupon_order'] = $data['code'];
                $order['price_coupon_order'] = $data['price_coupon'];
                $order['total_order'] = $data['total'];
            } else {
                $order['total_order'] = $data['total3'];
            }
            $order->save();
            Session::forget('coupon');
            Session::forget('addressOrder');
            Session::forget('deliveryFee');
            $id_o = $order->id_order;
        } else {
            Session::put('warning', 'Vui lòng nhập đầy đủ thông tin (*) để hoàn tất đặt hàng!');
            return Redirect::to('/login-checkout');
        }

        //add-orderDetail
        if (isset($data['name']) && isset($data['email']) && isset($data['address']) && isset($data['phone'])) {
            $cart = Cart::content();

            foreach ($cart as $c) {
                $product = Product::find($c->id);
                $product['stock2_product'] = $product->stock2_product - $c->qty;
                $product->save();

                $orderD = new OrderDetail();
                $orderD['id_order'] = $id_o;
                $orderD['code_order'] = $code_order;
                $orderD['id_product'] = $c->id;
                $orderD['name_productD'] = $c->name;
                $orderD['price_productD'] = $c->price;
                $orderD['priceOrigin_productD'] = $product->priceOrigin_product;
                $orderD['quantity'] = $c->qty;
                $orderD->save();
            }
        }

        if ($data['payment'] == 1) {
            # code...
        } elseif ($data['payment'] == 2) {
            Cart::destroy();
            // $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
            // $type = Brand::where('status_brand', 0)->get();

            // //Seo
            // $meta_desc = "Web demo cửa hàng bán điện thoại - Thông báo đặt hàng thành công";
            // $meta_keywords = "thông báo, notify";
            // $meta_title = "Notify | E-Shopper";
            // $url_canonical = $request->url();
            // //seo

            // return view('pages.notify.NotifyOrder')->with('category', $category)->with('type', $type)
            //     ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
        }

        //echo '<pre>'; print_r($data['total']); echo '</pre>';
    }
    public function showOrderSuccess(Request $request)
    {
        $category = Category::where('status_category', 0)->orderByDesc('id_category')->get();
        $type = Brand::where('status_brand', 0)->get();
        $banner = Banner::where('status_banner', 0)->orderByDesc('id_banner')->take(5)->get();
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Thông báo đặt hàng thành công";
        $meta_keywords = "thông báo, notify";
        $meta_title = "Notify | E-Shopper";
        $url_canonical = $request->url();
        //seo

        return view('pages.notify.NotifyOrder')->with('category', $category)->with('type', $type)
            ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner'));
    }

    //=====END FRONTEND

    public function AuthLoginA()
    {
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function showOrderStatus($status)
    {
        $this->AuthLoginA();

        $order = Order::orderBy('order.id_order', 'asc')->with(['payment', 'client']);
        switch ($status) {
            case 'wait':
                $order->where('order.status_order', '=', 'Đang chờ xử lý');
                break;
            case 'confirmed':
                $order->where('order.status_order', '=', 'Đã xác nhận đơn');
                break;
            case 'shipping':
                $order->where('order.status_order', '=', 'Đang vận chuyển');
                break;
            case 'delivered':
                $order->where('order.status_order', '=', 'Đã giao đơn');
                break;
            case 'cancelled':
                $order->where('order.status_order', '=', 'Đã hủy đơn');
                break;
            case 'refund':
                $order->where('order.status_order', '=', 'Hoàn trả');
                break;
            case 're-verify':
                $order->where('order.status_order', '=', 'Cần xác minh lại');
                break;
            case 'all':
                
                break;
        }
        $order = $order->get();
        $manager_order = view('admins.order.managerOrder')->with('order', $order)
        ->with(compact('status'));
        return view('homeA')->with('admins.order.managerOrder', $manager_order);
    }

    public function showOrderDetail($id)
    {
        $this->AuthLoginA();

        // $orderD = DB::table('order_details')
        //     ->join('order', 'order.id_order', '=', 'order_details.id_order')
        //     ->join('product', 'order_details.id_product', '=', 'product.id_product')
        //     ->select('order_details.*', 'product.img_product')
        //     ->where('order_details.id_order', '=', $id)
        //     ->get();

        // $order = DB::table('order')
        //     ->join('client', 'order.id_client', '=', 'client.id_client')
        //     ->join('payment', 'order.id_payment', '=', 'payment.id_payment')
        //     ->select('order.*', 'client.name', 'payment.description_payment')
        //     ->where('order.id_order', '=', $id)
        //     ->get();

        $orderD = OrderDetail::where('order_details.id_order', '=', $id)
            ->with('product')->get();

        $order = Order::where('order.id_order', '=', $id)->with(['payment', 'client'])->get();
        // echo '<pre>'; print_r($order->id_client); echo '</pre>';
        $manager_order = view('admins.order.orderDetail')->with('order', $order)->with('orderD', $orderD);
        return view('homeA')->with('admins.order.orderDetail', $manager_order);
    }

    public function updateOrder(Request $request, $id)
    {
        $date = getdate();
        $name_a = Auth::user()->name_admin;
        $id_a = Auth::user()->id_admin;
        $data = $request->all();
        $order = Order::find($id);

        $date_order = Carbon::parse($order->created_at)->format('Y-m-d');
        $statistic = Statistic::where('date_order_statistic', $date_order)->first();
        $total = 0; $quantity = 0; $profit = 0; $sales = 0;

        // $order['note_A'] = $data['noteA'];        
        if ($data['noteA'] != '') {
            $order['note_a'] = $order->note_a ."\n". $date['hours'] . ":" . $date['minutes'] ." ". $date['mday']."/".$date['mon']."/".$date['year'] ." - " . $data['status'] . " - " . $name_a . " (".$id_a."): " . $data['noteA'];
        }
        elseif ($data['noteA'] == '' && $order->status_order != $data['status']) {
            $order['note_a'] = $order->note_a ."\n". $date['hours'] . ":" . $date['minutes'] ." ". $date['mday']."/".$date['mon']."/".$date['year'] ." - " . $data['status'] . " - " . $name_a . " (".$id_a.")";
        }
        $detail = OrderDetail::where('id_order', $id)->get();
        foreach($detail as $od) {
            $id_p = $od->id_product;
            $product = Product::find($id_p);
            if ($order->status_order != $data['status'] && $data['status'] == 'Đã xác nhận đơn' && $order->status_order != "Cần xác minh lại" ) {
                $product['stock_product'] = $product->stock_product - $od->quantity;
                $product->save();
            }
            if ($order->status_order != $data['status'] && $data['status'] == 'Đã giao đơn') {
                $product['sold_product'] = $product->sold_product + $od->quantity;
                $product->save();

                $quantity = $quantity + $od->quantity;
                $total = 1;
                $sales = $sales + ($od->price_productD * $od->quantity);
                $profit = $profit + ($od->priceOrigin_productD * $od->quantity);
            }
            if ($order->status_order != $data['status'] && $data['status'] == 'Đã hủy đơn') {
                $product['stock_product'] = $product->stock_product + $od->quantity;
                $product['stock2_product'] = $product->stock2_product + $od->quantity;
                $product->save();
            }
            if ($order->status_order != $data['status'] && $data['status'] == 'Hoàn trả') {
                $quantity = $quantity + $od->quantity;
                $total = 1;
                $sales = $sales + ($od->price_productD * $od->quantity);
                $profit = $profit + ($od->priceOrigin_productD * $od->quantity);
            }
        }

        $profit = $sales - $profit;
        if ($order->status_order != $data['status'] && $data['status'] == 'Hoàn trả') {
            $statistic['profit_statistic'] = $statistic['profit_statistic'] - $profit;
            $statistic['sales_statistic'] = $statistic['sales_statistic'] - $sales;
            $statistic['quantity_statistic'] = $statistic['quantity_statistic'] - $quantity;
            $statistic['total_order_statistic'] = $statistic['total_order_statistic'] - $total;
            $statistic->save();
        } else if ($order->status_order != $data['status'] && $data['status'] == 'Đã giao đơn'){
            if ($statistic) {
                $statistic['profit_statistic'] = $statistic['profit_statistic'] + $profit;
                $statistic['sales_statistic'] = $statistic['sales_statistic'] + $sales;
                $statistic['quantity_statistic'] = $statistic['quantity_statistic'] + $quantity;
                $statistic['total_order_statistic'] = $statistic['total_order_statistic'] + $total;
                $statistic->save();
            }
            else if ($total == 1) {
                $statistic = new Statistic();
                $statistic['profit_statistic'] = $profit;
                $statistic['sales_statistic'] = $sales;
                $statistic['quantity_statistic'] = $quantity;
                $statistic['total_order_statistic'] = $total;
                $statistic['date_order_statistic'] = $date_order;
                $statistic->save();
            }
        }

        $order['status_order'] = $data['status'];
        $order->save();
        
        return Redirect::to('/admin/order-details/' . $id);
    }

    //=====END BACKEND
}
