@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Tài khoản Admin
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php

                    use Illuminate\Support\Facades\Session;

                    $mess = Session::get('message');
                    if ($mess) {
                        echo '<div class="alert-t alert-success">' . $mess . '</div>';
                        Session::put('message', null);
                    }
                    $warn = Session::get('warning');
                    if ($warn) {
                        echo '<div class="alert-t alert-danger">' . $warn . '</div>';
                        Session::put('warning', null);
                    }
                    foreach($errors->all() as $e) {
                        echo "<ul><li class='alert alert-warning'>".$e."</li></ul>";
                    }
                    ?>
                    <form role="form" action="{{ URL::to('/admin/add-admin') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-admin">Tên admin <span style="color: red;">*</span></label>
                            <input type="text" name="name_admin" class="form-control"
                            placeholder="Họ và tên" value="{{old('name_admin')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="email-admin">Email <span style="color: red;">*</span></label>
                            <input type="email" class="form-control " name="email_admin" placeholder="Email đăng nhập" 
                            value="{{old('email_admin')}}" required></input>
                        </div>
                        <div class="form-group">
                            <label for="password-admin">Mật khẩu <span style="color: red;">*</span></label>
                            <input type="password" class="form-control " name="password_admin" placeholder="Mật khẩu đăng nhập" required></input>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh admin</label>
                            <input type="file" id="exampleInputFile" name="img_admin">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="form-group">
                            <label for="phone-admin">SĐT <span style="color: red;">*</span></label>
                            <input type="tel" class="form-control " name="phone_admin" placeholder="SĐT liên hệ" 
                            value="{{old('phone_admin')}}" required></input>
                        </div>
                        <div class="form-group">
                            <label for="address-admin">Nơi ở hiện tại <span style="color: red;">*</span></label>
                            <div class="flex-group">
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
                                    <label for="address-order">Số nhà và tên đường</label>
                                    <input type="text" name="address_admin" class="form-control" 
                                    placeholder="Nhập địa chỉ nhà (số nhà và tên đường) *" value="{{old('address_admin')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="home-admin">Quê quán <span style="color: red;">*</span></label>
                            <input type="text" class="form-control " name="home_admin" placeholder="Quê quán" 
                            value="{{old('home_admin')}}" required></input>
                        </div>
                        <div class="form-group">
                            <label for="birth-admin">Ngày sinh <span style="color: red;">*</span></label>
                            <input type="date" class="form-control " name="birth_admin"
                            value="{{old('birth_admin')}}"></input>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Giới tính <span style="color: red;">*</span></label>
                            <select class="form-control m-bot15" name="sex_admin">
                                <option value="Nữ">Nữ</option>
                                <option value="Nam">Nam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái <span style="color: red;">*</span></label>
                            <select class="form-control m-bot15" name="status_admin">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_admin" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection