@extends('layouts.layoutC2')
@section('content')

<section id="client-info" style="margin-bottom: 20px;">
    <div class="container">
        <?php

        use Illuminate\Support\Facades\Session;

        $name_client = Session::get('name');
        $id_client = Session::get('id_client');
        ?>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Chi tiết đơn hàng đã mua</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="row">
            <div class="col-sm-3 menu-left">
                <div class="name-client">
                    <div>Xin chào <b>{{$name_client}}</b></div>
                </div>
                <ul>
                    <li><a href="{{URL::to('/client-info')}}" class="client-info"><i class="fa-solid fa-address-card"></i> Thông tin tài khoản</a></li>
                    <li><a href="{{URL::to('/client-order')}}" class="client-order active"><i class="fab fa-elementor"></i> Đơn hàng đã mua</a></li>
                </ul>
                <a onclick="return confirm('Bạn muốn Đăng Xuất khỏi tài khoản? Hành động này sẽ không được hoàn tác.')" href="{{URL::to('/logout')}}" class="btn-logout">Đăng xuất</a>
            </div>
            <div class="col-sm-9 content-right">
                <div class="profile">
                    <h2 style="margin: 0;">Chi tiết đơn hàng ({{$order->code_order}}) - <span style="color: 
                                <?php
                                switch ($order->status_order) {
                                    case "Đang chờ xử lý":
                                        echo "blue";
                                        break;
                                    case "Đã xác nhận đơn":
                                        echo "orange";
                                        break;
                                    case "Đang vận chuyển":
                                        echo "#b9b20c";
                                        break;
                                    case "Đã giao đơn":
                                        echo "green";
                                        break;
                                    case "Đã hủy đơn":
                                        echo "#b72929";
                                        break;
                                    case "Cần xác minh lại":
                                        echo "grey";
                                        break;
                                    default:
                                        echo "black";
                                }
                                ?>;">{{$order->status_order}}</span></h2>
                    <div class="profile-area">
                        <div class="detail-order-top">
                            <div class="order-info-user box-info">
                                <h3 style="margin: 0 0 10px;"><i class="fa-solid fa-location-dot"></i> Thông tin đơn hàng</h3>
                                <div><span>Người nhận:</span>
                                    <p>{{$order->name_order}} - {{$order->phone_order}}</p>
                                </div>
                                <div><span>Nơi nhận:</span>
                                    <p>{{$order->address_order}}</p>
                                </div>
                                <div><span>Thời gian:</span>
                                    <p>{{$order->created_at}} - {{$order->updated_at}}</p>
                                </div>
                                <div><span>Ghi chú:</span>
                                    <p>
                                        <?php if ($order->note_order == '') {
                                            echo "(Không có ghi chú)";
                                        } else echo $order->note_order; ?></p>
                                </div>
                            </div>
                            <div class="order-info-payment box-info">
                                <h3 style="margin: 0 0 10px;"><i class="fa-regular fa-credit-card"></i> Thông tin Thanh toán</h3>
                                <div>{{$order->payment->description_payment}}</div>
                            </div>
                        </div>
                        <div class="detail-order-bot box-info">
                            <h3 style="margin: 0 0 10px;"><i class="fa-solid fa-bag-shopping"></i> Thông tin sản phẩm</h3>
                            <div class="order-detail">
                                @foreach($orderD as $od)
                                <div class="product-item">
                                    <?php
                                    if ($od->product->img_product != '') {?>
                                        <img src="{{URL::to('/public/upload/product/'. $od->product->img_product)}}" alt="{{$od->product->img_product}}" width="80px">
                                    <?php } else {?>
                                        <img src="{{URL::to('/public/frontend/images/no-image.jpg')}}" alt="no-image.jpg" width="80px">
                                    <?php }
                                    ?>
                                    <div class="info-product" style="flex: 1;">
                                        <a href="{{URL::to('/product/'.$od->product->slug_product)}}">{{$od->name_productD}}</a>
                                        <div><span>Số lượng:</span> {{$od->quantity}}</div>
                                        <div><span>Giá:</span> {{number_format($od->price_productD)}}đ</div>
                                    </div>
                                    <div class="price-product"><span>Tổng:</span> <?php echo number_format($od->price_productD * $od->quantity) ?>đ</div>
                                </div>
                                @endforeach
                            </div>
                            <div class="order-price">
                                <div class="total_area">
                                    <ul>
                                        <li>Phí vận chuyển <span>{{number_format($order->fee_delivery_order)}}₫</span></li>
                                        <?php 
                                        if ($order->price_coupon_order != '') {?>
                                            <li>Giảm: <span>{{number_format($order->price_coupon_order)}}₫</span></li>
                                        <?php }
                                        ?>
                                        <li>Thành tiền (Đã bao gồm thuế): <span>{{number_format($order->total_order)}}₫</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection