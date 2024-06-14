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
                <li class="active">Lịch sử mua hàng</li>
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
                    <h2 style="margin: 0;">Đơn hàng đã mua</h2>
                    <?php
                    $count = 0;
                    foreach($order as $oo) {$count ++;}
                    if ($count == 0) {?>
                        <div class="no-order">Không có đơn hàng nào.</div>
                    <?php } else {?>
                        @foreach($order as $o)
                    <div class="profile-area box-info">
                        <div class="list-order">
                            <div class="item-head">
                                <div class="order-code"><b>Đơn hàng: </b> {{$o->code_order}}</div>
                                <div class="order-status" style="color: 
                                <?php
                                switch ($o->status_order) {
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
                                      echo "black"; }
                                ?>;">{{$o->status_order}}</div>
                            </div>
                            <div class="item-content">
                                <div class="content-left">
                                    <div>Ngày đặt: {{$o->created_at}}</div>
                                    <div>Tổng tiền: {{number_format($o->total_order)}}đ</div>
                                </div>
                                <div class="content-right">
                                    <a href="{{URL::to('/client-order-detail/'.$o->code_order)}}" class="btn btn-detail">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <?php }
                    ?>

                </div>
            </div>
        </div>
</section>
@endsection