@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mục Lọc
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
                    $warn = Session::get('warning');
                    if ($warn) {
                        echo '<div class="alert-t alert-danger">' . $warn . '</div>';
                        Session::put('warning', null);
                    }
                    ?>
                    <form role="form" action="{{ URL::to('/admin/add-sort') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-sort">Tên Sắp Xếp (Lọc)</label>
                            <input type="text" name="name_sort" class="form-control"  placeholder="Tên Sắp Xếp (Lọc)" required>
                        </div>
                        <div class="form-group">
                            <label for="href-sort">Đường dẫn</label>
                            <input type="text" name="href_sort" class="form-control"  placeholder="Đường dẫn" required>
                        </div>
                        <div class="form-group">
                            <label for="from-sort">Giá trị bắt đầu</label>
                            <input type="number" name="from_sort" class="form-control"  placeholder="Giá trị bắt đầu" required>
                        </div>
                        <div class="form-group">
                            <label for="to-sort">Giá trị kết thúc</label>
                            <input type="number" name="to_sort" class="form-control"  placeholder="Giá trị kết thúc" required>
                        </div>
                        <div class="form-group">
                            <label for="description-sort">Mô tả</label>
                            <textarea class="form-control" name="description_sort" 
                            style="resize: vertical;"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Dành cho loại sản phẩm</label>
                            <select class="form-control m-bot15" name="id_brand">
                                @foreach($brand as $b)
                                <option value="{{$b->id_brand}}">{{$b->name_brand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_sort">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_sort" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection