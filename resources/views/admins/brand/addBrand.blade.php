@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm loại sản phẩm
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
                    <form role="form" action="{{ URL::to('/admin/add-brand') }}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-brand">Tên loại</label>
                            <input type="text" name="name_brand" class="form-control" id="name-brand" placeholder="Tên loại sản phẩm" required>
                        </div>
                        <div class="form-group">
                            <label for="slug-brand">Slug</label>
                            <input type="text" name="slug_brand" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description-brand">Mô tả loại</label>
                            <textarea class="form-control " id="description-brand" name="description_brand" style="resize: vertical;" placeholder="Mô tả loại sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="key-brand">Từ khóa</label>
                            <input type="text" name="key_brand" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Thuộc Loại</label>
                            <select class="form-control m-bot15" name="parent_brand">
                                <option value="0">---Loại mục bậc 'Cha'---</option>
                                @foreach($brand as $br)
                                <option value="{{$br->id_brand}}">{{$br->name_brand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_brand">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_brand" class="btn btn-info">Thêm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection