@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
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
                    <form role="form" action="{{ URL::to('/admin/add-category-product') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-category-product">Tên danh mục</label>
                            <input type="text" name="name_category" class="form-control" id="name-category-product" placeholder="Tên mục sản phẩm" required>
                        </div>
                        <div class="form-group">
                            <label for="slug-category-product">Slug</label>
                            <input type="text" name="slug_category" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description-category-product">Mô tả danh mục</label>
                            <textarea class="form-control " id="description-category-product" name="description_category" style="resize: vertical;" placeholder="Mô tả danh mục sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="key-category-product">Từ khóa</label>
                            <input type="text" name="key_category" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh danh mục</label>
                            <input type="file" id="exampleInputFile" name="img_category">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Loại danh mục</label>
                            <select class="form-control m-bot15" name="type_category">
                                @foreach($brand as $key => $b)
                                @if($b->parent_brand == 0)
                                <option value="{{$b->id_brand}}">{{$b->name_brand}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_category">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_category" class="btn btn-info">Thêm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection