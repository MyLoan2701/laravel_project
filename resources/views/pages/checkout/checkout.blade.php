@extends('layouts.layoutC2')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Đặt hàng</li>
            </ol>
        </div><!--/breadcrums-->

        <!-- <div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div> -->
        <!--/checkout-options-->

        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('mess');
        if ($mess) {
            echo '<div class="alert-t alert-success">' . $mess . '</div>';
            Session::put('mess', null);
        }
        $warn = Session::get('warn');
        if ($warn) {
            echo '<div class="alert-t alert-warning alert-icon">' . $warn . '</div>';
            Session::put('warn', null);
        }

        $coupon = Session::get('coupon');
        $address = Session::get('addressOrder');
        $delivery = Session::get('deliveryFee');
        $delivery2 =Session::get('deliveryFee2')
        ?>
        <div class="register-req">
            <p>Hãy dùng tài khoản đã đăng ký để đăng nhập sẽ giúp bạn có thể xem lịch sử mua hàng và tiến hành thanh toán các sản phẩm đã chọn.</p>
            
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <form>
                <!-- <form action="{{URL::to('/save-order')}}" method="post"> -->
                    {{csrf_field()}}
                    <div class="col-sm-4 clearfix">
                        <div class="bill-to">
                            <p>Điền thông tin đơn hàng</p>
                            <div class="ipt">
                                <input type="email" placeholder="Email*" required name="email" value="{{$client->email}}" class="email-order">
                                <input type="text" placeholder="Tên người nhận hàng*" required name="name" value="{{$client->name}}" class="name-order">
                                <input type="tel" placeholder="Số điện thoại liên hệ*" required name="phone" value="{{$client->phone}}" class="phone-order">
                                <a class="btn btn-default address-order" href="#insert-address-order" 
                                data-toggle="modal" style="margin: 10px 0;">Nhập địa chỉ giao hàng</a>
                                <input type="text" placeholder="Địa chỉ giao hàng (số nhà, tên đường)*" 
                                required name="address" value="<?php  if (isset($address)) {echo $address;} elseif ($client->address != '') {echo $client->address;}  ?>" readonly
                                title="<?php if (isset($address)) {echo $address;} elseif ($client->address != '') {echo $client->address;} ?>" class="address-order3">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="order-message">
                            <p>Ghi chú đơn hàng (Nếu cần)</p>
                            <textarea name="note" placeholder="Ghi chú về đơn hàng của bạn" rows="16" class="note-order"></textarea>
                            <!-- <label><input type="checkbox"> Shipping to bill address</label> -->
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <?php

                        use Gloudemans\Shoppingcart\Facades\Cart;

                        $content = Cart::content();
                        ?>
                        <section id="do_action">
                            <div>
                                <div class="total_area">
                                    <ul>
                                        <li>Tổng <span>{{Cart::subtotal()}}₫</span></li>
                                        <li>Thuế <span>{{Cart::tax()}}₫</span></li>
                                        <li>Phí vận chuyển <span><?php
                                        $de = 0;
                                        if ($delivery) {
                                            $de = $fee->price_fee;
                                            echo number_format($de) . "đ";
                                        }elseif ($delivery2) {
                                            $de = $fee->price_fee;
                                            echo number_format($de) . "đ";
                                        } else echo $de; ?></span></li>
                                        <input type="hidden" name="fee_delivery_order" value="{{$de}}" class="fee-delivery-order">
                                        <li>Thành tiền <span><?php
                                        $tt = str_replace('.00', '', Cart::total());
                                        $tt = str_replace(',', '', $tt);
                                        $tt = (int)$tt;
                                        if ($delivery) {
                                            echo number_format($tt + $fee->price_fee) . "đ";
                                            $t3 = $tt + $fee->price_fee;
                                        }elseif ($delivery2) {
                                            echo number_format($tt + $fee->price_fee) . "đ";
                                            $t3 = $tt + $fee->price_fee;
                                        } else {
                                            echo Cart::total() . "đ";
                                            $t3 = Cart::total();
                                        }
                                        ?></span></li>
                                        <input type="hidden" name="total3" value="{{$t3}}" class="total-order3">
                                        @if($coupon)
                                        @foreach($coupon as $cou)
                                        <li>Mã giảm giá <span>{{$cou['code_coupon']}}</span></li>
                                        <input type="hidden" name="code_coupon_order" value="{{$cou['code_coupon']}}" class="code-coupon-order">
                                        <li>Giảm <span><?php
                                                        $t = str_replace('.00', '', $t3);
                                                        $t = str_replace(',', '', $t);
                                                        $t = (int)$t;
                                                        if ($cou['type_coupon'] == 1) {
                                                            $p = $t * ($cou['price_coupon'] / 100);
                                                            $stl = strlen($p); //The length of the discounted Price
                                                            $d = 1; //dividend
                                                            for ($i = 1; $i < $stl; $i++) {
                                                                $d = $d . "0";
                                                            }
                                                            $p = ceil($p / $d) * $d; //Discounted original price
                                                            $t = $t - $p;
                                                        ?>
                                                    -{{$cou['price_coupon']}}% ({{number_format($p)}}₫)
                                                <?php }
                                                        if ($cou['type_coupon'] == 2) {
                                                            $p = $cou['price_coupon'];
                                                            $t = $t - $p; ?>
                                                    -{{$cou['price_coupon']}}₫
                                                <?php }
                                                ?></span></li>
                                        <input type="hidden" name="price_coupon_order" value="{{$p}}" class="price-coupon-order">
                                        <li>Tổng tiền <span>{{number_format($t)}}₫</span></li>
                                        <input type="hidden" name="total2" value="{{$t}}" class="total-order">
                                        @endforeach
                                        @endif
                                    </ul>
                                    <a class="btn btn-default coupon" href="#insert-coupon" data-toggle="modal">Nhập mã giảm giá</a>
                                </div>
                            </div>
                            <!-- </div> -->
                        </section><!--/#do_action-->
                    </div>
                    <div class="col-sm-12">
                        <!-- <div>
                            <label><input type="radio" name="payment_option" value="1"> Thanh toán qua thẻ ATM</label>
                        </div>
                        <div>
                            <label><input type="radio" name="payment_option" value="2" checked> Thanh toán bằng tiền mặt (Trả tiền khi nhận hàng)</label>
                        </div> -->
                        <div class="form-group">
                            <label for="inputSuccess">Chọn Phương thức thanh toán</label>
                            <select class="form-control m-bot15 payment-order" name="payment_option">
                                <option value="2">Thanh toán bằng tiền mặt (Trả tiền khi nhận hàng)</option>
                                <option value="1">Thanh toán qua thẻ ATM</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <!-- <input type="submit" value="Hoàn thành đặt hàng" class="btn btn-default btn-order check_out"> -->
                        <button type="button" class="btn btn-default btn-order check_out">Hoàn thành đặt hàng</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- #insert-coupon Nhập mã giảm giá-->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="insert-coupon" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h3 class="modal-title text-center">Nhập mã giảm giá</h3>
                        <p class="text-center">(Mỗi lần chỉ có một mã giảm giá được sử dụng)</p>
                    </div>
                    <div class="modal-body div-center">
                        <form class="form-inline" role="form" action="{{ URL::to('/check-coupon') }}">
                            <input type="text" placeholder="Nhập mã giảm giá" name="coupon" class="ipt-coupon">
                            <button type="submit" class="btn btn-default">Gửi</button>
                            <a onclick="return confirm('Bạn muốn XÓA Mã giảm giá đã lưu? Hành động này sẽ không được hoàn tác.')" 
                            href="{{ URL::to('/unset-coupon/') }}" class="btn btn-default">Xóa</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#insert-coupon (Nhập mã giảm giá) -->

        <!-- #insert-address-order (Nhập địa chỉ giao hàng) -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="insert-address-order" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h3 class="modal-title text-center">Nhập dịa chỉ giao hàng</h3>
                    </div>
                    <div class="modal-body div-center">
                    <form role="form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="inputSuccess">Chọn Thành phố</label>
                            <select class="form-control m-bot15 choose-city choose" name="city" id="city">
                                <option value="">-----Chọn Thành phố-----</option>
                                @foreach($city as $key => $tp)
                                <option value="{{$tp->id_tp}}">{{$tp->name_tp}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Chọn Quận Huyện</label>
                            <select class="form-control m-bot15 choose-province choose" name="province" id="province">
                                <option value="">-----Chọn Quận Huyện-----</option>
                                <!-- @foreach($province as $qh)
                                <option value="{{$qh->id_qh}}">{{$qh->name_qh}}</option>
                                @endforeach -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Chọn Xã Phường</label>
                            <select class="form-control m-bot15 choose-wards" name="wards" id="wards">
                                <option value="">-----Chọn Xã Phường-----</option>
                                <!-- @foreach($wards as $xp)
                                <option value="{{$xp->id_xp}}">{{$xp->name_xp}}</option>
                                @endforeach -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address-order">Địa chỉ nhà</label>
                            <input type="text" name="address_order" id="address-order" class="form-control address-order2" placeholder="Nhập địa chỉ nhà (số nhà và tên đường) *">
                        </div>
                        <button type="button" name="add_address_order" class="btn btn-info add-address-order">Thêm</button>
                        <a onclick="return confirm('Bạn muốn XÓA địa chỉ đã lưu? Hành động này sẽ không được hoàn tác.')" 
                        href="{{ URL::to('/unset-address/') }}" class="btn btn-default">Xóa</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#insert-address-order (Nhập địa chỉ giao hàng) -->

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        <div class="table-responsive cart_info">

            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $key => $ct)
                    <tr>
                        <td class="cart_product">
                            <a href="{{URL::to('/product/'.$ct->id)}}">
                                <img src="{{URL::to('/public/upload/product/'.$ct->options->image)}}" alt="{{$ct->options->image}}" width="50">
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="{{URL::to('/product/'.$ct->id)}}">{{$ct->name}}</a></h4>
                            <p>Mã sản phẩm: {{$ct->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($ct->price)}}đ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="number" name="quantity" value="{{$ct->qty}}" autocomplete="off" size="2" disabled>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price"><?php echo number_format($ct->price * $ct->qty) ?>đ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" onclick="return confirm('Bạn muốn XÓA sản phẩm này khỏi giỏ hàng? Hành động này sẽ không được hoàn tác.')" href="{{URL::to('/del-item-cart/'.$ct->rowId)}}">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection