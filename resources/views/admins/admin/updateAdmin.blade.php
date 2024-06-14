@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chi tiết Tài khoản
            </header>
            <div class="panel-body">
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
                ?>
                <div class="position-center update">
                    <div class="detail-item">
                        <h3 class="text-center" style="padding: 10px;">Chi tiết Tài khoản</h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <?php
                                if ($admin->avatar_admin != '') { ?>
                                    <img src="{{ URL::to('public/upload/admin/'.$admin->avatar_admin) }}" alt="{{$admin->avatar_admin}}" height="80" width="80">
                                <?php } else { ?>
                                    <img src="{{URL::to('/public/frontend/images/no-image.jpg')}}" alt="no-image.jpg" width="80px">
                                <?php }
                                ?>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Tên: </span><span>{{ $admin->name_admin }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Email: </span><span>{{ $admin->email_admin }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">SĐT: </span><span>{{ $admin->phone_admin }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Nơi ở hiện tại: </span><span>{{ $admin->address_admin }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày sinh: </span><span>{{ $admin->birth_admin }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Giới tính: </span><span>{{ $admin->sex_admin }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Quê quán: </span><span>{{ $admin->hometown_admin }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày tạo: </span><span>{{ $admin->created_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày cập nhật cuối: </span><span>{{ $admin->updated_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Trạng thái: </span>
                                <span>
                                    <?php
                                    if ($admin->status_admin == 0) {
                                        echo 'Hoạt động';
                                    } elseif ($admin->status_admin == 1) {
                                        echo 'Dừng hoạt động';
                                    }
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="edit-item">
                        <h3 class="text-center" style="padding: 10px;">Cập nhật Tài khoản</h3>
                        <form role="form" action="{{ URL::to('/admin/update-admin/'.$admin->id_admin) }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name-admin">Họ và Tên</label>
                                <input type="text" name="name_admin" class="form-control" value="{{ $admin->name_admin }}">
                            </div>
                            <div class="form-group">
                                <label for="phone-admin">SĐT</label>
                                <input type="tel" name="phone_admin" class="form-control" value="{{ $admin->phone_admin }}">
                            </div>
                            <div class="form-group">
                                <label for="password-admin">Mật khẩu</label>
                                <input type="password" class="form-control " name="password_admin" placeholder="Mật khẩu đăng nhập"></input>
                            </div>
                            <div class="form-group">
                                <label for="address-admin">Nơi ở hiện tại </label>
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
                                        <input type="text" name="address_admin" class="form-control" placeholder="Nhập địa chỉ nhà (số nhà và tên đường) *">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="home-admin">Quê quán</label>
                                <input type="text" class="form-control " name="home_admin" value="{{ $admin->hometown_admin }}"></input>
                            </div>
                            <div class="form-group">
                                <label for="birth-admin">Ngày sinh</label>
                                <input type="date" class="form-control " name="birth_admin"></input>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Giới tính</label>
                                <select class="form-control m-bot15" name="sex_admin">
                                    @if ($admin->sex_admin == 'Nữ')
                                    <option selected value="Nữ">Nữ</option>
                                    <option value="Nam">Nam</option>
                                    @elseif($admin->sex_admin == 'Nam')
                                    <option value="Nữ">Nữ</option>
                                    <option selected value="Nam">Nam</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ảnh</label>
                                <input type="file" id="exampleInputFile" name="img_admin">
                                <p class="help-block">Example block-level help text here.</p>
                                <img src="{{ URL::to('public/upload/admin/'.$admin->avatar_admin) }}" alt="{{$admin->avatar_admin}}" width="100px">
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Trạng thái</label>
                                <select class="form-control m-bot15" name="status_admin">
                                    @if ($admin->status_admin == 0)
                                    <option selected value="0">Hoạt động</option>
                                    <option value="1">Dừng hoạt động</option>
                                    @elseif($admin->status_admin == 1)
                                    <option value="0">Hoạt động</option>
                                    <option selected value="1">Dừng hoạt động</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="update_admin" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection