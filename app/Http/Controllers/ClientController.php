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
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\tinhthanhpho;
use App\Models\quanhuyen;
use App\Models\xaphuongthitran;
use App\Models\FeeShip2;
use App\Models\Banner;
use Illuminate\Support\Facades\Redis;

class ClientController extends Controller
{
    public function signup(Request $request)
    {
        // $name = $request->name_client;
        // $email = $request->email;
        // $pwd = $request->password;
        // $phone = $request->phone;

        // if ($name == '' || $email == '' || $phone = '' || $pwd = '') {
        //     Session::put('warning', 'Vui lòng nhập đầy đủ thông tin để đăng ký tài khoản!');
        //     return Redirect::to('/login-checkout');
        // }
        // else {
        //     $data['name'] = $name;
        //     $data['email'] = $email;
        //     $data['password'] = md5($pwd);
        //     $data['phone'] = $phone;

        //     $add_client = DB::table('client')->insertGetId($data);
        //     Session::put('message', 'Bạn đã đăng ký tài khoản thành công, hãy đăng nhập để trải nghiệm tốt hơn!');
        //     return Redirect::to('/login-checkout');
        // }

        $data = $request->all();
        $client = new Client();
        if (
            isset($data['name_client']) && isset($data['email'])
            && isset($data['password']) && isset($data['phone'])
        ) {
            $clients = Client::all();
            $count = 0;
            foreach ($clients as $cl) {
                if ($cl->email == $data['email']) {
                    $count++;
                    Session::put('warning', 'Email đã được đăng ký sử dụng, vui lòng nhập email khác.');
                    return Redirect::to('/login-checkout');
                    break;
                }
            }
            if ($count == 0) {
                if (strlen($data['password'] < 6)) {
                    Session::put('warning', 'Mật khẩu phải chứa ít nhất 6 ký!');
                    return Redirect::to('/login-checkout');
                } else {
                    $client['name'] = $data['name_client'];
                    $client['email'] = $data['email'];
                    $client['password'] = md5($data['password']);
                    $client['phone'] = $data['phone'];
                    $client->save();
                    Session::put('message', 'Bạn đã đăng ký tài khoản thành công, hãy đăng nhập để trải nghiệm tốt hơn!');
                    return Redirect::to('/login-checkout');
                }
            }
        } else {
            Session::put('warning', 'Vui lòng nhập đầy đủ thông tin để đăng ký tài khoản!');
            return Redirect::to('/login-checkout');
        }
    }

    public function login(Request $request)
    {
        $data = $request->all();

        if (isset($data['email_login']) && isset($data['password_login'])) {
            $result = Client::where('email', $data['email_login'])
                ->where('password', md5($data['password_login']))->first();
            if ($result) {
                Session::put('name', $result->name);
                Session::put('email_client', $result->email);
                Session::put('id_client', $result->id_client);
                if ($result->address != '') {
                    $t = trim(str_replace(",", '', strrchr($result->address, ",")));
                    $delivery = tinhthanhpho::where('name_tp', $t)->first();
                    Session::put('deliveryFee2', $delivery->id_tp);
                }
                return Redirect::to('/');
            } else {
                Session::put('warning2', 'Email hoặc mật khẩu bạn nhập không đúng, vui lòng nhập lại!');
                return Redirect::to('/login-checkout');
            }
        } else {
            Session::put('warning2', 'Vui lòng nhập đầy đủ thông tin để đăng nhập tài khoản!');
            return Redirect::to('/login-checkout');
        }

        // $email = $request->email_login;
        // $pwd = md5($request->password_login);


        // if ($email == '') {
        //     Session::put('message', 'Vui lòng nhập đầy đủ thông tin để đăng nhập tài khoản!');
        //     return Redirect::to('/login-checkout');
        // }
        // elseif ($pwd == '') {
        //     Session::put('message', 'Vui lòng nhập đầy đủ thông tin để đăng nhập tài khoản!');
        //     return Redirect::to('/login-checkout');
        // }
        // else {

        //     $result = DB::table('client')->where('email', $email)->where('password', $pwd)->first();

        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        // echo $email;
        // echo '<br>';
        // echo $request->password_login;
        // echo '<br>';
        // echo $pwd;

        // if($result) {
        //     Session::put('name', $result->name);
        //     Session::put('id_client', $result->id_client);
        //     return Redirect::to('/');
        //  }
        //  else {
        //      Session::put('message', 'Email hoặc mật khẩu bạn nhập không đúng, vui lòng nhập lại!');
        //      return Redirect::to('/login-checkout');
        //  }
        //}
    }

    public function logout(Request $request)
    {
        Session::put('name', null);
        Session::put('id_client', null);
        Session::put('deliveryFee2', null);
        Session::put('deliveryFee', null);
        Session::put('coupon', null);
        Session::put('addressOrder', null);
        return Redirect::to('/');
    }
    public function clientInfo(Request $request)
    {
        $type = Brand::where('status_brand', 0)->get();

        $id_client = Session::get('id_client');
        if ($id_client) {
            $account = Client::find($id_client);
            $city = tinhthanhpho::all();
            //Seo
            $meta_desc = "Web demo cửa hàng bán điện thoại - Thông tin tài khoản khách hàng";
            $meta_keywords = "client info, account info, thông tin tài khoản";
            $meta_title = "Thông tin tài khoản | E-Shopper";
            $url_canonical = $request->url();
            //seo

            return view('pages.client.clientAccount')
                ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'account', 'city', 'type'));
        } else {
            return Redirect::to('/login-checkout')->send();
        }
    }
    public function clientOrder(Request $request)
    {
        $type = Brand::where('status_brand', 0)->get();
        $id_client = Session::get('id_client');
        if ($id_client) {
            $account = Client::find($id_client);
            $order = Order::where('id_client', $id_client)->get();
            //Seo
            $meta_desc = "Web demo cửa hàng bán điện thoại - Thông tin tài khoản khách hàng";
            $meta_keywords = "lịch sử mua hàng";
            $meta_title = "Lịch sử mua hàng | E-Shopper";
            $url_canonical = $request->url();
            //seo

            return view('pages.client.clientOrder')
                ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'account', 'order', 'type'));
        } else {
            return Redirect::to('/login-checkout')->send();
        }
    }
    public function clientOrderDetail(Request $request, $code)
    {
        $type = Brand::where('status_brand', 0)->get();
        $id_client = Session::get('id_client');
        if ($id_client) {
            $account = Client::find($id_client);
            $order = Order::where('code_order', $code)->where('id_client', $id_client)->with(['payment', 'client'])->first();
            if (isset($order->id_order)) {
                $orderD = OrderDetail::where('order_details.id_order', '=', $order->id_order)->with('product')->get();
                //Seo
                $meta_desc = "Web demo cửa hàng bán điện thoại - Thông tin tài khoản khách hàng";
                $meta_keywords = "chi tiết đơn hàng đã mua";
                $meta_title = "Chi tiết đơn hàng đã mua | E-Shopper";
                $url_canonical = $request->url();
                //seo
                return view('pages.client.clientOrderDetail')
                    ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'account', 'order', 'orderD', 'type'));
            }
            else {
                return Redirect::to('/client-order');
            }
        } else {
            return Redirect::to('/login-checkout')->send();
        }
    }
    public function updateAccount(Request $request)
    {
        $id_client = Session::get('id_client');
        $data = $request->all();
        $client = Client::find($id_client);

        if (isset($data['sex'])) {
            if (isset($data['p_new'])) {
                if (
                    $client['sex'] == $data['sex'] && $client['name'] == $data['name']
                    && $client['phone'] == $data['phone'] && $client['password'] == md5($data['p_new'])
                ) {
                    echo '<div class="alert-t alert-warning alert-icon">Không có gì thay đổi.</div>';
                } else {
                    $client['sex'] = $data['sex'];
                    $client['name'] = $data['name'];
                    $client['phone'] = $data['phone'];
                    if ($client['password'] == md5($data['p_new'])) {
                        $client->save();
                        echo '<div class="alert-t alert-success">Cập nhật thành công.</div>' . '<div class="alert-t alert-warning alert-icon">Mật khẩu không có gì thay đổi.</div>';
                    } else {
                        $client['password'] = md5($data['p_new']);
                        $client->save();
                        echo '<div class="alert-t alert-success">Cập nhật thành công.</div>';
                    }
                }
            } else {
                if (
                    $client['sex'] == $data['sex'] && $client['name'] == $data['name']
                    && $client['phone'] == $data['phone']
                ) {
                    echo '<div class="alert-t alert-warning alert-icon">Không có gì thay đổi.</div>';
                } else {
                    $client['sex'] = $data['sex'];
                    $client['name'] = $data['name'];
                    $client['phone'] = $data['phone'];
                    $client->save();
                    echo '<div class="alert-t alert-success">Cập nhật thành công.</div>';
                }
            }
        } else {
            if (isset($data['p_new'])) {
                if (
                    $client['name'] == $data['name'] && $client['phone'] == $data['phone']
                    && $client['password'] == md5($data['p_new'])
                ) {
                    echo '<div class="alert-t alert-warning alert-icon">Không có gì thay đổi.</div>';
                } else {
                    $client['name'] = $data['name'];
                    $client['phone'] = $data['phone'];
                    if ($client['password'] == md5($data['p_new'])) {
                        $client->save();
                        echo '<div class="alert-t alert-success">Cập nhật thành công.</div>' . '<div class="alert-t alert-warning alert-icon">Mật khẩu không có gì thay đổi.</div>';
                    } else {
                        $client['password'] = md5($data['p_new']);
                        $client->save();
                        echo '<div class="alert-t alert-success">Cập nhật thành công.</div>';
                    }
                }
            } else {
                if ($client['name'] == $data['name'] && $client['phone'] == $data['phone']) {
                    echo '<div class="alert-t alert-warning alert-icon">Không có gì thay đổi.</div>';
                } else {
                    $client['name'] = $data['name'];
                    $client['phone'] = $data['phone'];
                    $client->save();
                    echo '<div class="alert-t alert-success">Cập nhật thành công.</div>';
                }
            }
        }
    }
    public function updateAddress(Request $request)
    {
        $id_client = Session::get('id_client');
        $data = $request->all();
        $client = Client::find($id_client);

        $data = $request->all();
        $city = tinhthanhpho::where('id_tp', $data['city'])->select('name_tp')->first();
        $province = quanhuyen::where('id_qh', $data['province'])->select('name_qh')->first();
        $wards = xaphuongthitran::where('id_xp', $data['wards'])->select('name_xp')->first();
        $address = $data['address'] . ", " . $wards->name_xp . ", " . $province->name_qh . ", " . $city->name_tp;

        if ($client['address'] == $address) {
            echo '<div class="alert-t alert-warning alert-icon">Không có gì thay đổi.</div>';
        } else {
            $client['address'] = $address;
            Session::put('deliveryFee2', $data['city']);
            $client->save();
            echo '<div class="alert-t alert-success">Cập nhật thành công. Làm mới trang để xem thay đổi.</div>';
        }
    }
    public function delAddressClient(Request $request) {
        $id_client = Session::get('id_client');
        $client = Client::find($id_client);
        $client['address'] = '';
        $client->save();
        Session::put('deliveryFee2', null);
        return Redirect::to('/client-info');
    }
}
