@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Mã giảm giá
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
            <table class="table table-striped b-t b-light" id="tableAllCoupon">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã Mã giảm giá</th>
                        <th>Tên Mã giảm giá</th>
                        <th>Mã giảm giá</th>
                        <th>Mức giảm giá</th>
                        <th>Trạng thái</th>
                        <th>Chi Tiết</th>
                        @hasrole(['Admin', 'Author'])
                        <th style="width:30px;">Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_coupon as $key => $coupon)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $coupon->id_coupon }}</td>
                        <td>{{ $coupon->name_coupon }}</td>
                        <td>{{ $coupon->code_coupon }}</td>
                        <td>
                            <?php
                            if ($coupon->type_coupon == 1) {?>
                                -{{ $coupon->price_coupon }}%
                            <?php
                            }
                            elseif ($coupon->type_coupon == 2) {?>
                                -{{ $coupon->price_coupon }}₫
                            <?php
                            }
                            ?>
                        </td>
                        <td class="text-primary">
                            <?php
                            if ($coupon->status_coupon == 0) {
                                echo 'Hoạt động';
                            } else {
                                echo 'Dừng hoạt động';
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::to('/admin/show-detail-coupon/'.$coupon->id_coupon) }}">
                                Chi tiết
                            </a>
                        </td>
                        <td>
                        <a onclick="return confirm('Bạn muốn XÓA mã giảm giá này? Hành động này sẽ không được hoàn tác.')" 
                            href="{{ URL::to('/admin/del-coupon/'.$coupon->id_coupon) }}" >
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection