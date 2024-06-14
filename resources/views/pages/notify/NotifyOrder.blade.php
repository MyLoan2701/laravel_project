@extends('layouts.layoutC2')
@section('content')

<section id="notify notify_order">
    <div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Thông báo</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="notify_order_success">
            <h3 class="text-center">Bạn đã đặt hàng thành công!</h3>
            <p class="text-center">Cảm ơn bạn đã lựa chọn sản phẩm tại cửa hàng chúng tôi. Chúng tôi sẽ liên hệ với bạn sớm nhất có thể.</p>
        </div><!--/register-req-->
    </div>
</section> <!--/#cart_items-->
@endsection