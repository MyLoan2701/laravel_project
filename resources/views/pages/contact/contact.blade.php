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
                <li class="active">Liên hệ</li>
            </ol>
        </div><!--/breadcrums-->

        <div id="contact-page" class="container">
            <div class="bg">
                <div class="row">
                    <div class="col-sm-7">
                        <h2 class="title text-center">Thông tin cửa hàng</h2>
                        <div class="info-contact-store">
                            <p><b>Địa chỉ:</b> XXX Núi Thành, Hoà Cường Nam, Hải Châu, Đà Nẵng</p>
                            <p><b>Số điện thoại:</b> (028) 27 123 565</p>
                            <p><b>Gọi mua:</b> 1800 2202</p>
                            <p><b>Tổng đài tư vấn, hỗ trợ khách hàng (7:30 - 22:00): </b>1900 222 000</p>
                            <p><b>Tổng đài khiếu nại (8:00 - 21:30):</b> 1800 2711</p>
                            <p><b>Email:</b> cskh@UIT.com</p>
                            <p><b>Fax:</b> 028 27 123 565</p>
                        </div>
                        <div id="gmap" class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15338.564434770242!2d108.2220601!3d16.0321875!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219ee598df9c5%3A0xaadb53409be7c909!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaeG6v24gdHLDumMgxJDDoCBO4bq1bmc!5e0!3m2!1svi!2s!4v1716823640396!5m2!1svi!2s" 
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <h2 class="title text-center"><strong>UIT Shopper</strong> Hân hạnh được hỗ trợ quý khách</h2>
                        <div class="register-req">
                            <p>Bất kỳ vấn đề nào về cửa hàng bạn muốn chia sẻ với chúng tôi, hãy điền thông tin vào bên dưới. Chúng tôi sẽ tiếp thu và phản hồi bạn trong khả năng có thể.</p>
                        </div><!--/register-req-->
                    
                        <div class="contact-form">
                            <h2 class="title text-center">Liên hệ</h2>
                            <?php
                            $mess = Session::get('message');
                            if ($mess) {
                                echo '<div class="alert-t alert-success">' . $mess . '</div>';
                                Session::put('message', null);
                            }
                            $warn2 = Session::get('warning');
                            if ($warn2) {
                                echo '<div class="alert-t alert-warning alert-icon">' . $warn2 . '</div>';
                                Session::put('warning', null);
                            }
                            ?>
                            <div class="status alert alert-success" style="display: none"></div>
                            <form action="{{URL::to('/send-contact')}}" id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                                {{csrf_field()}}
                                <div class="form-group col-md-12">
                                    <input type="text" name="name" class="form-control" required="required" placeholder="Họ và tên (*)">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" name="phone" class="form-control" required="required" placeholder="Số điện thoại (*)">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" required="required" placeholder="Email (*)">
                                    <?php
                                    if (isset($id_client)) { ?>
                                        <input type="hidden" name="id_client" class="form-control" required="required" value="{{$id_client}}">
                                    <?php }
                                    ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="subject" class="form-control" required="required" placeholder="Vấn đề (*)">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Tin nhắn của bạn... (*)"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/#contact-page-->
</section>
@endsection