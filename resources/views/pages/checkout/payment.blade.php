@extends('welcome')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Thanh toán</li>
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

        <div class="register-req">
            <p>Hãy dùng tài khoản đã đăng ký để đăng nhập sẽ giúp bạn có thể xem lịch sử mua hàng và tiến hành thanh toán các sản phẩm đã chọn.</p>
        </div><!--/register-req-->

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        <div class="table-responsive cart_info">
            <?php

            use Gloudemans\Shoppingcart\Facades\Cart;

            $content = Cart::content();
            ?>
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
                            <p>${{$ct->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="number" name="quantity" value="{{$ct->qty}}" autocomplete="off" size="2" disabled>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$<?php echo $ct->price * $ct->qty ?></p>
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
        <div class="payment-options">
            <span>
                <label><input type="checkbox" name="payment_option"> Thanh toán qua thẻ ATM</label>
            </span>
            <span>
                <label><input type="checkbox" name="payment_option"> Thanh toán bằng tiền mặt (Trả tiền khi nhận hàng)</label>
            </span>
            <!-- <span>
                <label><input type="checkbox"> Paypal</label>
            </span> -->
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection