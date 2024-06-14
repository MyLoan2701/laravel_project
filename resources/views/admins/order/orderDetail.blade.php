@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Chi tiết đơn hàng
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('message');
        if ($mess) {
            echo '<div class="alert-t alert-success" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('message', null);
        }
        ?>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row w3-res-tb">
            @foreach($order as $o)
            <div class="col-sm-4 order-left">
                <div class="show-top">
                    <h4 class="text-center">Thông tin vận chuyển</h4>
                </div>
                <div class="show-bottom">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>Mã khách hàng</label>
                            <span>{{$o->id_client}}</span>
                        </li>
                        <li class="list-group-item">
                            <label>Tên người mua</label>
                            <span>{{$o->client->name}}</span>
                        </li>
                        <li class="list-group-item">
                            <label>Địa chỉ giao hàng</label>
                            <span>{{$o->address_order}}</span>
                        </li>
                        <li class="list-group-item">
                            <label>Số điện thoại liên hệ</label>
                            <span>{{$o->phone_order}}</span>
                        </li>
                        <li class="list-group-item">
                            <label>Tên người nhận hàng</label>
                            <span>{{$o->name_order}}</span>
                        </li>
                        <li class="list-group-item">
                            <label>Ghi chú đơn hàng của người mua</label>
                            <span>{{$o->note_order}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-8 order-right">
                <div class="show-top">
                    <h4 class="text-center">Thông tin đơn hàng</h4>
                </div>
                <div class="show-bottom">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>Mã đơn hàng</label>
                            <span>{{$o->id_order}} - ({{$o->code_order}})</span>
                        </li>
                        <li class="list-group-item">
                            <label>Ngày tạo</label>
                            <span>{{$o->created_at}}</span>
                        </li>
                        <li class="list-group-item">
                            <label>Thanh toán</label>
                            <span>{{$o->payment->description_payment}}</span>
                        </li>
                        <li class="list-group-item">
                            <label>Trạng thái đơn</label>
                            <span>{{$o->status_order}}</span>
                        </li>
                        <li class="list-group-item">
                            <label>Tổng tiền</label>
                            <span>{{number_format($o->total_order)}}đ</span>
                        </li>
                        <li class="list-group-item">
                            <label>Ghi chú của admin</label>
                            <pre>{{$o->note_a}}</pre>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Mã Chi tiết</th>
                                <th>Ảnh</th>
                                <th>Mô tả</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th>Hàng còn trong kho</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderD as $key => $od)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                <td>{{ $od->id_order }}</td>
                                <td><a href="{{URL::to('/product/'.$od->product->slug_product)}}" target="_blank" 
                                    title="Đến trang sản phẩm cửa hàng">
                                <img src="{{URL::to('/public/upload/product/'.$od->product->img_product)}}" alt="{{$od->img_product}}" width="50">
                                </a></td>
                                <td>
                                    <h4><a href="{{URL::to('/admin/show-edit-product/'.$od->id_product)}}" target="_blank" 
                                    title="Đến trang sản phẩm Admin">{{$od->name_productD}}</a></h4>
                                    <p>Mã sản phẩm: {{$od->id_product}}</p>
                                    <p>Giá sản phẩm: {{number_format($od->price_productD)}}đ</p>
                                    <p>Giá gốc: {{number_format($od->priceOrigin_productD)}}đ</p>
                                </td>
                                <td>{{ $od->quantity}}</td>
                                <td class="text-primary"><?php echo number_format($od->price_productD * $od->quantity) ?>đ</td>
                                <td>{{$od->product->stock_product}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>Mã giảm giá: {{$o->code_coupon_order}}</td>
                                <td>Giảm: -{{number_format($o->price_coupon_order)}}đ</td>
                                <td>Phí vận chuyển: {{number_format($o->fee_delivery_order)}}đ</td>
                                <td>Tổng tiền (Đã tính thuế): {{number_format($o->total_order)}}đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 m-bot15">
                <form action="{{URL::to('/admin/update-orderA/'.$o->id_order)}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="noteA">Ghi chú đơn hàng của nhân viên</label>
                        <textarea name="noteA" id="noteA" style="resize: vertical;" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng thái đơn</label>
                        <select name="status" id="status" class="form-control m-bot15">
                            <option value="{{$o->status_order}}">{{$o->status_order}}</option>
                            
                            <?php 
                            if ($o->status_order == 'Đang chờ xử lý') {?>
                                <option value="Đã xác nhận đơn">Đã xác nhận đơn</option>
                                <option value="Cần xác minh lại">Cần xác minh lại</option>
                                <option value="Đã hủy đơn">Đã hủy đơn</option>
                            <?php
                            }
                            if ($o->status_order == 'Đã xác nhận đơn') {?>
                                <option value="Đang vận chuyển">Đang vận chuyển</option>
                                <option value="Cần xác minh lại">Cần xác minh lại</option>
                            <?php
                            }
                            if ($o->status_order == 'Đang vận chuyển') {?>
                                <option value="Đã giao đơn">Đã giao đơn</option>
                                <option value="Cần xác minh lại">Cần xác minh lại</option>
                            <?php
                            }
                            if ($o->status_order == 'Cần xác minh lại') {?>
                                <option value="Đã xác nhận đơn">Đã xác nhận đơn</option>
                                <option value="Đã hủy đơn">Đã hủy đơn</option>
                            <?php
                            }
                            if ($o->status_order == 'Đã giao đơn') {?>
                                <option value="Hoàn trả">Hoàn trả</option>
                            <?php
                            }
                            ?>
                            
                        </select>
                    </div>
                    <button type="submit" name="update-order" class="btn btn-info">Cập nhật đơn hàng</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection