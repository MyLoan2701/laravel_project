@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chi tiết danh mục sản phẩm
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
                    @foreach($edit_category as $key => $category)
                    <div class="detail-item">
                        <h3 class="text-center" style="padding: 10px;">Chi tiết danh mục</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><span><img src="{{ URL::to('public/upload/category/'.$category->img_category) }}" alt="{{$category->img_category}}" width="100px"></span> <span>{{ $category->name_category }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Mô tả: </span><span>{{ $category->description_category }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày tạo: </span><span>{{ $category->created_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày cập nhật cuối: </span><span>{{ $category->updated_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Loại danh mục: </span> <span>{{ $category->name_brand }}</span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Trạng thái: </span>
                                <span>
                                    <?php
                                    if ($category->status_category == 0) {
                                        echo 'Hoạt động';
                                    } elseif ($category->status_category == 1) {
                                        echo 'Dừng hoạt động';
                                    }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Số lượng sản phẩm thuộc danhh mục: </span></li>
                        </ul>
                    </div>
                    @hasrole(['Admin', 'Author'])
                    <div class="edit-item">
                        <h3 class="text-center" style="padding: 10px;">Cập nhật danh mục</h3>
                        <form role="form" action="{{ URL::to('/admin/update-category-product/'.$category->id_category) }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name-category-product">Tên danh mục</label>
                                <input type="text" name="name_category" class="form-control" id="name-category-product" 
                                value="{{ $category->name_category }}">
                            </div>
                            <div class="form-group">
                                <label for="slug-category-product">Slug</label>
                                <input type="text" name="slug_category" class="form-control" value="{{$category->slug_category}}">
                            </div>
                            <div class="form-group">
                                <label for="description-category-product">Mô tả danh mục</label>
                                <textarea class="form-control " name="description_category" style="resize: vertical;" placeholder="Mô tả danh mục sản phẩm">{{ $category->description_category }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ảnh danh mục</label>
                                <input type="file" id="exampleInputFile" name="img_category">
                                <p class="help-block">Example block-level help text here.</p>
                                <img src="{{ URL::to('public/upload/category/'.$category->img_category) }}" alt="{{$category->img_category}}" width="100px">
                            </div>
                            <div class="form-group">
                                <label for="key-category-product">Từ khóa</label>
                                <input type="text" name="key_category" class="form-control" value="{{$category->key_category}}">
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Loại danh mục</label>
                                <select class="form-control m-bot15" name="id_brand">
                                    @foreach($brand as $key => $b)
                                    @if ($category->id_brand == $b->id_brand)
                                    <option selected value="{{$b->id_brand}}">{{$b->name_brand}}</option>
                                    @else
                                    <option value="{{$b->id_brand}}">{{$b->name_brand}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Trạng thái</label>
                                <select class="form-control m-bot15" name="status_category">
                                    @if ($category->status_category == 0)
                                    <option selected value="0">Hoạt động</option>
                                    <option value="1">Dừng hoạt động</option>
                                    @elseif($category->status_category == 1)
                                    <option value="0">Hoạt động</option>
                                    <option selected value="1">Dừng hoạt động</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                    @endhasrole
                    @endforeach
                </div>

            </div>
        </section>

    </div>
</div>
@endsection