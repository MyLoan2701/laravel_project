@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Phí vận chuyển
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
                                <!-- @foreach($province as $qh)
                                <option value="{{$qh->id_qh}}">{{$qh->name_qh}}</option>
                                @endforeach -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Chọn Xã Phường</label>
                            <select class="form-control m-bot15 choose-wards" name="wards" id="wards">
                                <option value="">-----Chọn Xã Phường-----</option>
                                <!-- @foreach($wards as $xp)
                                <option value="{{$xp->id_xp}}">{{$xp->name_xp}}</option>
                                @endforeach -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fee-delivery">Phí vận chuyển</label>
                            <input type="text" name="price_fee" id="fee-delivery" class="form-control fee-price" placeholder="Nhập phí vận chuyển">
                        </div>
                        <button type="button" name="add_delivery" class="btn btn-info add-delivery">Thêm</button>
                    </form>
                </div>
                <div class="table-delivery">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th style="width:20px;">
                                        <label class="i-checks m-b-none">
                                            <input type="checkbox"><i></i>
                                        </label>
                                    </th>
                                    <th>Mã Phí vận chuyển</th>
                                    <th>Tỉnh / Thành phố</th>
                                    <th>Quận / Huyện</th>
                                    <th>Xã Phường / Thị trấn</th>
                                    <th>Mức phí (Sửa)</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="load-delivery">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection