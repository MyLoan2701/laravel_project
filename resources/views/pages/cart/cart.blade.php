@extends('layouts.layoutC2')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>

        <?php

        use Gloudemans\Shoppingcart\Facades\Cart;
        use Illuminate\Support\Facades\Session;

        $content = Cart::content();
        $count = 0;
        foreach ($content as $c) {
            $count++;
        }
        //     echo '<pre>';
        // print_r($content);
        // echo '</pre>';
        if ($count == 0) {
            Session::forget('coupon'); ?>
            <div class="cart-empty text-center">
                <h2 style="color: #ff8b00;">Giỏ hàng trống!</h2>
                <p>Hãy chọn sản phẩm bạn muốn mua để thêm vào giỏ hàng.</p>
                <img src="{{URL::to('/public/frontend/images/cart-empty.jpg')}}" alt="cart-empty">
            </div>
        <?php
        } else { ?>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="description">Mô tả</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền</td>
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
                                <p>{{number_format($ct->price)}}₫</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form>
                                        {{csrf_field()}}
                                        <input class="cart_quantity_input cart-item-qty-{{$ct->id}}" type="number" name="quantity" value="{{$ct->qty}}" 
                                        autocomplete="off" size="2" min="1" max="5">
                                        <input type="hidden" name="rowId" value="{{$ct->rowId}}" class="cart-item-rowId-{{$ct->id}}">
                                        <input type="hidden" name="stock" value="{{$ct->options->stock2_product}}" class="cart-item-stock-{{$ct->id}}">
                                        <button type="button" class="btn btn-default btn-sm update-item-cart" data-id="{{$ct->id}}">Cập nhật</button>
                                    </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price"><?php echo number_format($ct->price * $ct->qty) ?>₫</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" onclick="return confirm('Bạn muốn XÓA sản phẩm này khỏi giỏ hàng? Hành động này sẽ không được hoàn tác.')" href="{{URL::to('/del-item-cart/'.$ct->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</section> <!--/#cart_items-->

<?php
if ($count != 0) { ?>
    <section id="do_action">
        <div class="container">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::subtotal()}}₫</span></li>
                        <li>Thuế <span>{{Cart::tax()}}₫</span></li>
                        <li>Phí vận chuyển <span>0</span></li>
                        <li>Thành tiền <span>{{Cart::total()}}₫</span></li>
                    </ul>
                    <a class="btn btn-default update" href="{{URL::to('/checkout')}}">Đặt hàng</a>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </section><!--/#do_action-->
<?php
}
?>

@endsection