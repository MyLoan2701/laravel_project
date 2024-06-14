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
                <li class="active">Thông tin tài khoản</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="row">
            <div class="col-sm-3 menu-left">
                <div class="name-client">
                    <div>Xin chào <b>{{$name_client}}</b></div>
                </div>
                <ul>
                    <li><a href="{{URL::to('/client-info')}}" class="client-info active"><i class="fa-solid fa-address-card"></i> Thông tin tài khoản</a></li>
                    <li><a href="{{URL::to('/client-order')}}" class="client-order"><i class="fab fa-elementor"></i> Đơn hàng đã mua</a></li>
                </ul>
                <a onclick="return confirm('Bạn muốn Đăng Xuất khỏi tài khoản? Hành động này sẽ không được hoàn tác.')" href="{{URL::to('/logout')}}" class="btn-logout">Đăng xuất</a>
            </div>
            <div class="col-sm-9 content-right">
                <div class="profile">
                    <h2 style="margin: 0;">Thông tin tài khoản</h2>
                    <div class="profile-area box-info">
                        <h3 style="margin: 0;">Thông tin cá nhân</h3>
                        <div class="profile-main">
                            <div class="profile-info ">
                                <p>
                                    <?php
                                    if ($account->sex == 'Nữ') {
                                        echo "Chị ";
                                    }
                                    elseif ($account->sex == 'Nam') {
                                        echo "Anh ";
                                    }
                                    ?>{{$name_client}} - {{$account->phone}}</p>
                                <a onclick="changeDisplayProfile()" id="profile-edit"><i class="far fa-edit"></i> Sửa</a>
                            </div>
                            
                            <div class="profile-edit-form" id="profile-edit-form">
                                <div id="notify-account"></div>
                                <form>
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <input type="radio" id="sex-client" name="sex" value="Nữ" 
                                        <?php 
                                        if ($account->sex == 'Nữ') {
                                            echo "checked";
                                        }?>>
                                        <label for="Nữ" class="lb-edit">Chị</label>
                                        <input type="radio" id="sex-client" name="sex" value="Nam" style="margin-left: 25px;"
                                        <?php 
                                        if ($account->sex == 'Nam') {
                                            echo "checked";
                                        }?>>
                                        <label for="Nam" class="lb-edit">Anh</label>
                                    </div>
                                    <div id="warn-empty-input-account"></div>
                                    <div class="flex-form-input">
                                        <div class="form-group">
                                            <label for="name-client">Họ và tên</label>
                                            <input type="text" name="name_client" class="form-control name-client" id="name-client" 
                                            placeholder="Họ và tên" required value="{{$name_client}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="phone-client">SĐT</label>
                                            <input type="tel" name="phone_client" class="form-control phone-client" id="phone-client" 
                                            placeholder="Số điện thoại" required value="{{$account->phone}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-client">Email</label>
                                        <input type="email" name="email_client" class="form-control email-client" id="email-client" placeholder="Email" required readonly value="{{$account->email}}">
                                    </div>
                                    <div class="form-group password-form-input">
                                        <div id="warn-empty-input-account2"></div>
                                        <label for="password-client">Sửa mật khẩu</label>
                                        <!-- <input type="password" name="password_old" class="form-control password-old" id="password-old" placeholder="Nhập Mật khẩu cũ"> -->
                                        <input type="password" name="password_new" class="form-control password-new" id="password-new" placeholder="Nhập Mật khẩu mới">
                                        <input type="password" name="password_re_enter" class="form-control password-re-enter" id="password-re-enter" placeholder="Nhập lại Mật khẩu mới">
                                    </div>
                                    <div class="text-center">
                                        <a onclick="changeDisplayProfile2()" id="cancel-edit-profile" class="btn btn-danger">Hủy</a>
                                        <button type="button" name="edit_account_client" class="btn btn-info edit-account-client">Sửa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="profile-address box-info">
                        <h3 style="margin: 0;">Địa chỉ nhận hàng</h3>
                        <div class="address-main">
                            <div class="profile-info ">
                                <p>
                                    <?php
                                    if ($account->address != '') {
                                        echo $account->address;
                                    } else {
                                        echo "Chưa cập nhật.";
                                    }
                                    ?>
                                </p>
                                <a onclick="changeDisplayProfile3()" id="address-edit"><i class="far fa-edit"></i> Sửa</a>
                            </div>
                            <div class="profile-edit-form" id="address-edit-form">
                                <div id="notify-account2"></div>
                                <form>
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
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSuccess">Chọn Xã Phường</label>
                                        <select class="form-control m-bot15 choose-wards" name="wards" id="wards">
                                            <option value="">-----Chọn Xã Phường-----</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address-order">Địa chỉ nhà</label>
                                        <input type="text" name="address_order" id="address-order" class="form-control address-order2" 
                                        placeholder="Nhập địa chỉ nhà (số nhà và tên đường) *">
                                    </div>
                                    <div class="text-center">
                                        <a onclick="changeDisplayProfile4()" id="cancel-edit-profile" class="btn btn-danger">Hủy</a>
                                        <?php
                                        if ($account->address != '') {?>
                                            <a onclick="return confirm('Bạn muốn XÓA địa chỉ đã lưu? Hành động này sẽ không được hoàn tác.')" 
                                            href="{{ URL::to('/del-address-client/') }}" class="btn btn-default">Xóa</a>
                                        <?php } ?>
                                        <button type="button" name="edit_address_client" class="btn btn-info add-address-order-account">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection