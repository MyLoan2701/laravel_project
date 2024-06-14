@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Mã giảm giả
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
                    ?>
                    <form role="form" action="{{ URL::to('/admin/add-coupon') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-coupon">Tên mã giảm giá</label>
                            <input type="text" name="name_coupon" class="form-control" id="name-coupon" placeholder="Tên mã giảm giá" required>
                        </div>
                        <div class="form-group">
                            <label for="code-coupon">Mã giảm giá</label>
                            <input type="text" name="code_coupon" class="form-control" id="code-coupon" placeholder="Mã giảm giá" required>
                        </div>
                        <div class="form-group">
                            <label for="type-coupon">Tính năng mã</label>
                            <select name="type_coupon" id="type-coupon" class="form-control">
                                <option value="1">Giảm theo phần trăm (%)</option>
                                <option value="2">Giảm theo mức tiền (₫)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price-coupon">Nhập số % hoặc số tiền giảm</label>
                            <input type="number" class="form-control " id="price-coupon" 
                            name="price_coupon" placeholder="Nhập số % hoặc số tiền giảm"></input>
                        </div>
                        <div class="form-group">
                            <label for="limit-coupon">Có giới hạn số lần nhập mã không?</label>
                            <select name="limit_coupon" id="limit-coupon" class="form-control">
                                <option value="yes">Giới hạn số người nhập mã</option>
                                <option value="no">Không giới hạn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="limit-number-coupon">Nhập số lượng giới hạn</label>
                            <input type="number" name="limit_number_coupon" class="form-control" 
                            id="limit-number-coupon" placeholder="Nhập số lượng giới hạn" min="1">
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
                            <textarea class="form-control " id="description-coupon" name="description_coupon" style="resize: vertical;" placeholder="Mô tả mã"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_coupon">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection