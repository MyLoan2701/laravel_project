@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Tài khoản Admin
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('message');
        if ($mess) {
            echo '<div class="alert-t alert-success" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('message', null);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="tableAllAdmin">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã Tài khoản</th>
                        <th>Tên Admin</th>
                        <th>Email đăng nhập</th>
                        <th>Ảnh</th>
                        <th>Trạng thái</th>
                        <th>Chi Tiết</th>
                        <th style="width:30px;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admin as $key => $a)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $a->id_admin }}</td>
                        <td>{{ $a->name_admin }}</td>
                        <td>{{ $a->email_admin }}</td>
                        <td>
                            <?php
                            if ($a->avatar_admin == '') {
                                echo "Chưa cập nhật";
                            }
                            else {?>
                            <img src="{{ URL::to('public/upload/admin/'.$a->avatar_admin) }}" alt="{{$a->avatar_admin}}" width="150px">
                            <?php }?>
                        </td>
                        <td class="text-primary">
                            <?php
                            if ($a->status_admin == 0) {
                                echo 'Hoạt động';
                            } else {
                                echo 'Dừng hoạt động';
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::to('/admin/show-edit-admin/'.$a->id_admin) }}">
                                Chi tiết
                            </a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn muốn XÓA tài khoản này? Hành động này sẽ không được hoàn tác.')" href="{{ URL::to('/admin/del-admin/'.$a->id_admin) }}">
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                    </tr>


                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection