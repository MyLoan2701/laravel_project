@extends('homeA')
@section('adminContent')
<?php 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Phí vận chuyển (2)
            </header>
            <div class="panel-body">
                @hasrole(['Admin', 'Author'])
                <div class="position-center">
                    <?php
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
                            <label for="fee-delivery">Phí vận chuyển</label>
                            <input type="text" name="price_fee" id="fee-delivery" class="form-control fee-price" placeholder="Nhập phí vận chuyển">
                        </div>
                        <button type="button" name="add_delivery" class="btn btn-info add-delivery2">Thêm</button>
                    </form>
                </div>
                @endhasrole
                <div class="table-delivery">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light" id="tableAllDelivery">
                            <thead>
                                <tr>
                                    <th style="width:20px;">
                                        <label class="i-checks m-b-none">
                                            <input type="checkbox"><i></i>
                                        </label>
                                    </th>
                                    <th>Mã Phí vận chuyển</th>
                                    <th>Tỉnh / Thành phố</th>
                                    <th>Mức phí (Sửa)</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="load-delivery2">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection