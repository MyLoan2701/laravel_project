@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: inherit;">
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/show-all-product')}}">Tất cả Sản phẩm</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/show-edit-product/'. $gallery->id_product)}}">{{$gallery->product->name_product}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">cập nhật thư viện hình ảnh của {{$gallery->product->name_product}}</li>
                    </ol>
                </nav>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php

                    ?>
                    <form role="form" action="{{ URL::to('/admin/update-gallery/'.$gallery->id_gallery) }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-gallery">Tên hình ảnh</label>
                            <input type="text" name="name_gallery" class="form-control" value="{{$gallery->name_gallery}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh sản phẩm</label>
                            <input type="file" id="exampleInputFile" name="img_gallery" accept="image/*">
                            <p class="help-block">Example block-level help text here.</p>
                            <img src="{{ URL::to('public/upload/gallery/'.$gallery->img_gallery) }}" alt="{{$gallery->name_gallery}}" width="50px">
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_gallery">
                                @if ($gallery->status_gallery == 0)
                                <option selected value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                                @elseif($gallery->status_gallery == 1)
                                <option value="0">Hoạt động</option>
                                <option selected value="1">Dừng hoạt động</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="update_gallery" class="btn btn-info">Cập nhật</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection