@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Quản lý đơn hàng
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('message');
        if ($mess) {
            echo '<div class="alert-t alert-success" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('message', null);
        }
        ?>
        <div class="status-order">
            <a href="{{URL::to('/admin/show-order/wait')}}" class="<?php echo ($status == 'wait') ? 'active' : '' ; ?> waiting">Chờ xác nhận </a>
            <a href="{{URL::to('/admin/show-order/confirmed')}}" class="<?php echo ($status == 'confirmed') ? 'active' : '' ; ?> confirmed">Đã xác nhận </a>
            <a href="{{URL::to('/admin/show-order/shipping')}}" class="<?php echo ($status == 'shipping') ? 'active' : '' ; ?> shipping">Vận chuyển </a>
            <a href="{{URL::to('/admin/show-order/delivered')}}" class="<?php echo ($status == 'delivered') ? 'active' : '' ; ?> delivered">Đã giao </a>
            <a href="{{URL::to('/admin/show-order/cancelled')}}" class="<?php echo ($status == 'cancelled') ? 'active' : '' ; ?> cancelled">Đã hủy </a>
            <a href="{{URL::to('/admin/show-order/refund')}}" class="<?php echo ($status == 'refund') ? 'active' : '' ; ?> refund">Hoàn trả </a>
            <a href="{{URL::to('/admin/show-order/re-verify')}}" class="<?php echo ($status == 're-verify') ? 'active' : '' ; ?> re-verify">Cần xác minh lại</a>
            <a href="{{URL::to('/admin/show-order/all')}}" class="<?php echo ($status == 'all') ? 'active' : '' ; ?> all">Tất cả</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="tableAllOrder">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã Đơn Hàng</th>
                        <th>Tên người nhận</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Thanh Toán</th>
                        <th>Chi Tiết</th>
                        <th style="width:30px;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $key => $o)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $o->id_order }} - {{$o->code_order}}</td>
                        
                        <td>{{ $o->name_order }}</td>
                        <td>{{ number_format($o->total_order)}}</td>
                        <td style="color: <?php switch ($o->status_order) {
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
                            case "Hoàn trả":
                                echo "black";
                                break;
                        }?>;">{{ $o->status_order }}</td>
                        <td>{{ $o->payment->method_payment}}</td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::to('/admin/order-details/'.$o->id_order) }}">
                                Chi tiết
                            </a>
                        </td>
                        <td>
                            <a href="#del-categoryP" data-toggle="modal">
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                    </tr>

                    <!-- #del-categoryP (Xóa danh mục sản phẩm) -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="del-categoryP" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h3 class="modal-title text-center">Bạn muốn xóa danh mục này?</h3>
                                    <p class="text-muted text-center font-italic">(Hành động này sẽ không được hoàn tác.)</p>
                                </div>
                                <div class="modal-body div-center">
                                    <form class="form-inline" role="form" action="{{ URL::to('/admin/del-order/'.$o->id_order) }}">
                                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /#del-categoryP (Xóa danh mục sản phẩm) -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection