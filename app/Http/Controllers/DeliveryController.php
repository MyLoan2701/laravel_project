<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\tinhthanhpho;
use App\Models\quanhuyen;
use App\Models\xaphuongthitran;
use App\Models\FeeShip;
use App\Models\FeeShip2;

class DeliveryController extends Controller
{
    //
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
    // public function showAllDelivery() {
    //     $this->AuthLogin();
    //     $fee = FeeShip::with(['tinhthanhpho', 'quanhuyen', 'xaphuongthitran'])->get();
    //     return view('admins.delivery.allDelivery')->with(compact('fee'));
    // }
    public function showAddDelivery() {
        $this->AuthLogin();
        $city = tinhthanhpho::all();
        $province = quanhuyen::orderby('id_qh', 'asc')->get();
        $wards = xaphuongthitran::orderby('id_xp', 'asc')->get();
        $fee = FeeShip::with(['tinhthanhpho', 'quanhuyen', 'xaphuongthitran'])->get();
        return view('admins.delivery.addDelivery')->with(compact('city', 'province', 'wards', 'fee'));
    }
    public function showAddDelivery2() {
        $this->AuthLogin();
        $city = tinhthanhpho::all();
        $fee = FeeShip2::with(['tinhthanhpho'])->get();
        return view('admins.delivery.addDelivery2')->with(compact('city', 'fee'));
    }
    public function allDelivery() {
        $this->AuthLogin();
        $fee = FeeShip::with(['tinhthanhpho', 'quanhuyen', 'xaphuongthitran'])->get();
        $output = '';
        foreach($fee as $f) {
            $output .= '<tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>'.$f->id_fee.'</td>
            <td>'.$f->tinhthanhpho->name_tp.'</td>
            <td>'.$f->quanhuyen->name_qh.'</td>
            <td>'.$f->xaphuongthitran->name_xp.'</td>
            <td contenteditable="" data-id-fee="'.$f->id_fee.'" class="edit-fee-ship">'.number_format($f->price_fee).'</td>
            <td>
                <a onclick="return confirm(&lsquo;'.'Bạn muốn XÓA phí vận chuyển này? Hành động này sẽ không được hoàn tác.&rsquo;'.')" 
                href="../admin/del-delivery/'.$f->id_fee.'">
                    <span class="glyphicon glyphicon-trash icon-trash"></span>
                </a>
            </td>
        </tr>';
        }
        echo $output;
    }
    public function allDelivery2() {
        $this->AuthLogin();
        $fee = FeeShip2::with(['tinhthanhpho'])->get();
        $output = '';
        foreach($fee as $f) {
            $output .= '<tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>'.$f->id_fee.'</td>
            <td>'.$f->tinhthanhpho->name_tp.'</td>
            <td contenteditable="" data-id-fee="'.$f->id_fee.'" class="edit-fee-ship2">'.number_format($f->price_fee).'</td>
            <td>
                <a onclick="return confirm(&lsquo;'.'Bạn muốn XÓA phí vận chuyển này? Hành động này sẽ không được hoàn tác.&rsquo;'.')" 
                href="../admin/del-delivery2/'.$f->id_fee.'">
                    <span class="glyphicon glyphicon-trash icon-trash"></span>
                </a>
            </td>
        </tr>';
        }
        echo $output;
    }
    public function selectDelivery(Request $request) {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            $action = $data['action'];
            if ($action == "city") {
                $select = quanhuyen::where('id_tp', $data['ma_id'])->orderby('id_qh', 'asc')->get();
                $output .= '<option value="">-----Chọn Quận Huyện-----</option>';
                foreach($select as $s) {
                    $output .= '<option value="'.$s->id_qh.'">'.$s->name_qh.'</option>';
                }
            }
            else {
                $select2 = xaphuongthitran::where('id_qh', $data['ma_id'])->orderby('id_xp', 'asc')->get();
                $output .= '<option value="">-----Chọn Xã phường-----</option>';
                foreach($select2 as $s2) {
                    $output .= '<option value="'.$s2->id_xp.'">'.$s2->name_xp.'</option>';
                }
            }
        }
        echo $output;
    }

    public function addDelivery(Request $request) {
        $data = $request->all();
        
        $fee = new FeeShip();
        $fee->id_tp = $data['city'];
        $fee->id_qh = $data['province'];
        $fee->id_xp = $data['wards'];
        $fee->price_fee = $data['fee'];
        $fee->save();
        // print_r($fee);
    }
    public function addDelivery2(Request $request) {
        $data = $request->all();
        
        $fee = new FeeShip2();
        $fee->id_tp = $data['city'];
        $fee->price_fee = $data['fee'];
        $fee->save();
        // print_r($fee);
    }
    public function updateDelivery(Request $request) {
        $data = $request->all();
        
        $fee = FeeShip::find($data['id_fee']);
        $fee->price_fee = $data['fee_value'];
        $fee->save();
        // print_r($fee);
    }
    public function updateDelivery2(Request $request) {
        $data = $request->all();
        
        $fee = FeeShip2::find($data['id_fee']);
        $fee->price_fee = $data['fee_value'];
        $fee->save();
        // print_r($fee);
    }
    public function delDelivery($id) {        
        $fee = FeeShip::find($id);
        $fee->delete();
        return Redirect::to('/admin/show-add-delivery');
        // print_r($fee);
    }
    public function delDelivery2($id) {        
        $fee = FeeShip2::find($id);
        $fee->delete();
        return Redirect::to('/admin/show-add-delivery2');
        // print_r($fee);
    }
}
