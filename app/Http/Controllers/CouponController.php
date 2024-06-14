<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;

class CouponController extends Controller
{
    //
    public function checkCoupon(Request $request) {
        $data = $request->all();
        $coupon = Coupon::where('code_coupon', $data['coupon'])->first();
        if ($coupon) {
            if ($coupon->count() > 0) {//Mã giảm tồn tại
                if ($coupon->status_coupon == 0) {//Còn hoạt động
                    $date_app = $coupon->date_coupon;
                    $date_exp = $coupon->exp_date_coupon;
                    $date = date('Y-m-d');
                    if ($date_app != '' && $date_exp != '') { //Tồn tại giới hạn thời gian áp dụng
                        
                        // echo $date . "<br>";
                        // echo $date_app . "<br>";
                        // echo $date_exp . "<br>";
                        // echo ($date_app <= $date ) . "<br>";
                        if ($date_app <= $date && $date_exp >= $date) {# Còn hạn sử dụng
                            $coupon_session = Session::get('coupon');
                            $cou[] = array(
                                'code_coupon' => $coupon->code_coupon,
                                'type_coupon' => $coupon->type_coupon,
                                'price_coupon' => $coupon->price_coupon
                            );
                            Session::put('coupon', $cou);
                            Session::save();
                            Session::put('mess', 'Thêm mã giảm giá thành công.');
                            return redirect()->back();
                        }
                        else //Không nằm trong phạm vi thời gian sử dụng
                        {
                            Session::put('warn', 'Mã giảm giá không thể áp dụng trong thời gian hiện tại.');
                            return redirect()->back();
                            //return redirect()->back()->with('warn', 'Mã giảm giá không thể áp dụng trong thời gian hiện tại.');
                        }
                    }
                    elseif ($date_app == '' && $date_exp == '') {
                        $coupon_session = Session::get('coupon');
                        $cou[] = array(
                            'code_coupon' => $coupon->code_coupon,
                            'type_coupon' => $coupon->type_coupon,
                            'price_coupon' => $coupon->price_coupon
                        );
                        Session::put('coupon', $cou);
                        Session::save();
                        Session::put('mess', 'Thêm mã giảm giá thành công.');
                        return redirect()->back();
                    }
                    elseif ($date_app != '' && $date_exp == '') {
                        if ($date_app <= $date) {
                            $coupon_session = Session::get('coupon');
                            $cou[] = array(
                                'code_coupon' => $coupon->code_coupon,
                                'type_coupon' => $coupon->type_coupon,
                                'price_coupon' => $coupon->price_coupon
                            );
                            Session::put('coupon', $cou);
                            Session::save();
                            Session::put('mess', 'Thêm mã giảm giá thành công.');
                            return redirect()->back();
                        }
                        else //Không nằm trong phạm vi thời gian sử dụng
                        {
                            Session::put('warn', 'Mã giảm giá không thể áp dụng trong thời gian hiện tại.');
                            return redirect()->back();
                            //return redirect()->back()->with('warn', 'Mã giảm giá không thể áp dụng trong thời gian hiện tại.');
                        }
                    }
                    elseif ($date_app == '' && $date_exp != '') {
                        if ($date_exp >= $date) {
                            $coupon_session = Session::get('coupon');
                            $cou[] = array(
                                'code_coupon' => $coupon->code_coupon,
                                'type_coupon' => $coupon->type_coupon,
                                'price_coupon' => $coupon->price_coupon
                            );
                            Session::put('coupon', $cou);
                            Session::save();
                            Session::put('mess', 'Thêm mã giảm giá thành công.');
                            return redirect()->back();
                        }
                        else //Không nằm trong phạm vi thời gian sử dụng
                        {
                            Session::put('warn', 'Mã giảm giá không thể áp dụng trong thời gian hiện tại.');
                            return redirect()->back();
                            //return redirect()->back()->with('warn', 'Mã giảm giá không thể áp dụng trong thời gian hiện tại.');
                        }
                    }
                }
                else {
                    Session::put('warn', 'Mã giảm giá hiện không hoạt động.');
                    return redirect()->back();
                }
            }
        }else { //Không tồn tại mã giảm giá
            Session::put('warn', 'Mã giảm giá không đúng.');
            return redirect()->back();
        }
    }
    public function unsetCoupon () {
        Session::forget('coupon');
        return redirect()->back();
    }
    //=====END FUNCTION CLIENT PAGE=====

    public function AuthLogin() {
        //kiểm tra đã đăng nhập trước khi truy cập các trang liên quan đến admin
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        }
        else {
            return Redirect::to('/admin')->send();
        }
    }

    public function showAddCoupon() {
        $this->AuthLogin();
        return view('admins.coupon.addCoupon');
    }

    public function showAllCoupon() {
        $this->AuthLogin();
        $all_coupon = Coupon::all();
        $manager_coupon = view('admins.coupon.allCoupon')->with('all_coupon', $all_coupon);
        return view('homeA')->with('admins.coupon.allCoupon', $manager_coupon);
    }
    public function showUpdateCoupon($id) {
        $this->AuthLogin();
        $coupon = Coupon::find($id);
        $manager_coupon = view('admins.coupon.updateCoupon')->with('coupon', $coupon);
        return view('homeA')->with('admins.coupon.updateCoupon', $manager_coupon);
    }

    public function addCoupon(Request $request) {
        $data = $request->all();
        // print_r($data);
        $coupon = new Coupon();
        $coupon->name_coupon = $data['name_coupon'];
        $coupon->code_coupon = $data['code_coupon'];
        $coupon->type_coupon = $data['type_coupon'];
        $coupon->price_coupon = $data['price_coupon'];
        $coupon->limit_coupon = $data['limit_coupon'];
        $coupon->limit_number_coupon = $data['limit_number_coupon'];
        $coupon->date_coupon = $data['date_coupon'];
        $coupon->exp_date_coupon = $data['exp_date_coupon'];
        $coupon->description_coupon = $data['description_coupon'];
        $coupon->status_coupon = $data['status_coupon'];
        $coupon->save();

        Session::put('message', 'Thêm mã giảm giá thành công.');

        return Redirect::to('/admin/show-add-coupon');
    }

    public function updateCoupon (Request $request, $id){
        $data = $request->all();
        $coupon = Coupon::find($id);
        $coupon->name_coupon = $data['name_coupon'];
        $coupon->code_coupon = $data['code_coupon'];
        $coupon->type_coupon = $data['type_coupon'];
        $coupon->price_coupon = $data['price_coupon'];
        $coupon->limit_coupon = $data['limit_coupon'];
        $coupon->limit_number_coupon = $data['limit_number_coupon'];
        $coupon->date_coupon = $data['date_coupon'];
        $coupon->exp_date_coupon = $data['exp_date_coupon'];
        $coupon->description_coupon = $data['description_coupon'];
        $coupon->status_coupon = $data['status_coupon'];
        $coupon->save();

        Session::put('message', 'Cập nhật mã giảm giá thành công.');

        return Redirect::to('/admin/show-detail-coupon/'.$id);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
    }
    public function delCoupon($id) {
        $coupon = Coupon::find($id);
        $coupon->delete();
        Session::put('message', 'Xóa mã giảm giá thành công.');

        return Redirect::to('/admin/show-all-coupon');
    }
    //=====END FUNCTION ADMIN PAGE=====

}
