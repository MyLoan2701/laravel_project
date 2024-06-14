@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chi tiết Mã giảm giá
            </header>
            <div class="panel-body">
                <?php

                use Illuminate\Support\Facades\Session;

                $mess = Session::get('message');
                if ($mess) {
                    echo '<div class="alert-t alert-success">' . $mess . '</div>';
                    Session::put('message', null);
                }
                ?>
                <div class="position-center update">
                    <div class="detail-item">
                        <h3 class="text-center" style="padding: 10px;">Chi tiết Mã giảm giá</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">Mã (id) Mã giảm: </span> <span>{{ $coupon->id_coupon }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Tên Mã giảm: </span> <span>{{ $coupon->name_coupon }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Code Mã giảm: </span> <span>{{ $coupon->code_coupon }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Loại mã giảm: </span> <span><?php
                                        if ($coupon->type_coupon == 1) { ?>
                                        Giảm theo phần trăm (%)
                                    <?php } elseif ($coupon->type_coupon == 2) { ?>
                                        Giảm theo mức tiền (₫)
                                    <?php }
                                    ?></span> / <span class="font-weight-bold">Giảm: </span><span><?php
                                        if ($coupon->type_coupon == 1) { ?>
                                        -{{$coupon->price_coupon}}%
                                    <?php } elseif ($coupon->type_coupon == 2) { ?>
                                        -{{$coupon->price_coupon}}%₫
                                    <?php }
                                    ?></span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Giới hạn: </span><span><?php
                                        if ($coupon->limit_coupon == 'yes') { ?>
                                        Có giới hạn số người nhập mã ({{$coupon->limit_number_coupon}})
                                    <?php } elseif ($coupon->limit_coupon == 'no') { ?>
                                        Không giới hạn số người nhập mã
                                    <?php }
                                    ?></span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày áp dụng: </span><span>{{ $coupon->date_coupon }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày hết hạn: </span><span>{{ $coupon->exp_date_coupon }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Mô tả: </span><span>{{ $coupon->description_coupon }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày tạo: </span><span>{{ $coupon->created_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày cập nhật cuối: </span><span>{{ $coupon->updated_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Trạng thái: </span>
                                <span>
                                    <?php
                                    if ($coupon->status_coupon == 0) {
                                        echo 'Hoạt động';
                                    } elseif ($coupon->status_coupon == 1) {
                                        echo 'Dừng hoạt động';
                                    }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Số lần đã sử dụng mã: </span></li>
                        </ul>
                    </div>
                    @hasrole(['Admin', 'Author'])
                    <div class="edit-item">
                        <h3 class="text-center" style="padding: 10px;">Cập nhật loại sản phẩm</h3>
                        <form role="form" action="{{ URL::to('/admin/update-coupon/'.$coupon->id_coupon) }}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name-coupon">Tên mã giảm giá</label>
                                <input type="text" name="name_coupon" class="form-control" id="name-coupon" placeholder="Tên mã giảm giá" required value="{{$coupon->name_coupon}}">
                            </div>
                            <div class="form-group">
                                <label for="code-coupon">Mã giảm giá</label>
                                <input type="text" name="code_coupon" class="form-control" id="code-coupon" placeholder="Mã giảm giá" required value="{{$coupon->code_coupon}}">
                            </div>
                            <div class="form-group">
                                <label for="type-coupon">Tính năng mã</label>
                                <select name="type_coupon" id="type-coupon" class="form-control">
                                    <?php
                                    if ($coupon->type_coupon == 2) { ?>
                                        <option selected value="2">Giảm theo mức tiền (₫)</option>
                                        <option value="1">Giảm theo phần trăm (%)</option>
                                    <?php }
                                    elseif ($coupon->type_coupon == 1) { ?>
                                        <option selected value="1">Giảm theo phần trăm (%)</option>
                                        <option value="2">Giảm theo mức tiền (₫)</option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price-coupon">Nhập số % hoặc số tiền giảm</label>
                                <input type="number" class="form-control " id="price-coupon" name="price_coupon" 
                                placeholder="Nhập số % hoặc số tiền giảm" value="{{$coupon->price_coupon}}"></input>
                            </div>
                            <div class="form-group">
                                <label for="limit-coupon">Có giới hạn số lần nhập mã không?</label>
                                <select name="limit_coupon" id="limit-coupon" class="form-control">
                                    <?php
                                    if ($coupon->limit_coupon == 'no') { ?>
                                        <option selected value="no">Không giới hạn</option>
                                        <option value="yes">Giới hạn số người nhập mã</option>
                                    <?php }
                                    elseif ($coupon->limit_coupon == 'yes') { ?>
                                        <option selected value="yes">Giới hạn số người nhập mã</option>
                                        <option value="no">Không giới hạn</option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="limit-number-coupon">Nhập số lượng giới hạn</label>
                                <input type="number" name="limit_number_coupon" class="form-control" id="limit-number-coupon" 
                                placeholder="Nhập số lượng giới hạn" min="1" value="{{$coupon->limit_number_coupon}}">
                            </div>
                            <div class="form-group">
                                <label for="date-coupon">Nhập ngày áp dụng</label>
                                <input type="date" name="date_coupon" class="form-control" id="date-coupon">
                            </div>
                            <div class="form-group">
                                <label for="exp-date-coupon">Nhập ngày hết hạn</label>
                                <input type="date" name="exp_date_coupon" class="form-control" id="exp-date-coupon">
                            </div>
                            <div class="form-group">
                                <label for="description-coupon">Mô tả</label>
                                <textarea class="form-control " id="description-coupon" name="description_coupon" style="resize: vertical;" placeholder="Mô tả mã">{{$coupon->description_coupon}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Trạng thái</label>
                                <select class="form-control m-bot15" name="status_coupon">
                                    <?php
                                    if ($coupon->status_coupon == 1) { ?>
                                        <option selected value="1">Dừng hoạt động</option>
                                        <option value="0">Hoạt động</option>
                                    <?php }
                                    if ($coupon->status_coupon == 0) { ?>
                                        <option selected value="0">Hoạt động</option>
                                        <option value="1">Dừng hoạt động</option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="add_coupon" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                    @endhasrole
                </div>

            </div>
        </section>

    </div>
</div>
@endsection