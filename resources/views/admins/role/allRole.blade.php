@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Quyền truy cập Tài khoản Admin
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('warning');
        if ($mess) {
            echo '<div class="alert-t alert-warning" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('warning', null);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="tableAllRole">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Thông tin tài khoản</th>
                        @foreach($role as $r)
                        <th>
                            <p>{{$r->name_role}} ({{$r->id_role}})
                                <a class="btn" href="{{ URL::to('/admin/show-edit-role/'.$r->id_role) }}">
                                    Chi tiết
                                </a>
                            </p>
                        </th>
                        @endforeach
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admin as $key => $a)
                    <tr>
                        <form action="{{URL::to('/admin/role-admin')}}" method="post">
                            {{csrf_field()}}
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>
                                <p>{{ $a->name_admin }} - ({{ $a->id_admin }})</p>
                                <p>{{ $a->email_admin }}</p>
                                <p class="text-primary">
                                    <?php
                                    if ($a->status_admin == 0) {
                                        echo 'Hoạt động';
                                    } else {
                                        echo 'Dừng hoạt động';
                                    } ?>
                                </p>
                                <input type="hidden" name="email_admin" value="{{ $a->email_admin }}" required>
                            </td>
                            @foreach($role as $r)
                            <td>
                                <input type="checkbox" name="{{$r->name_role}}" {{$a->hasRole($r->name_role) ? 'checked' : ''}}>
                            </td>
                            @endforeach
                            <td><button type="submit" name="role_admin" class="btn btn-info">Phân Quyền</button></td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection