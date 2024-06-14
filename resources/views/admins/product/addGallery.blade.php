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
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/show-edit-product/'. $id_product)}}">{{$product->name_product}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm thư viện hình ảnh của {{$product->name_product}}</li>
                    </ol>
                </nav>
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
                    <form role="form" action="{{ URL::to('/admin/add-gallery') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-gallery">Tên hình ảnh</label>
                            <input type="text" name="name_gallery" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh sản phẩm</label>
                            <input type="file" id="exampleInputFile" name="img_gallery" accept="image/*">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_gallery">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <input type="hidden" name="id_product" value="{{$id_product}}">
                        <button type="submit" name="add_gallery" class="btn btn-info">Thêm</button>
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
                                    <th>Mã (ID)</th>
                                    <th>Tên hình ảnh</th>
                                    <th>Hình ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Nút</th>
                                </tr>
                            </thead>
                            <tbody id="load-tag-post">
                                @foreach($gallery as $g)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                    <td>{{$g->id_gallery}}</td>
                                    <td>{{$g->name_gallery}}</td>
                                    <td><img src="{{ URL::to('public/upload/gallery/'.$g->img_gallery) }}" alt="{{$g->name_gallery}}" width="100px"></td>
                                    <td><?php
                                        if ($g->status_gallery == 0) {
                                            echo '<span class="text-success">Hoạt động</span>';
                                        } else {
                                            echo '<span class="text-danger">Dừng hoạt động</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ URL::to('/admin/show-edit-gallery/'.$g->id_gallery) }}">
                                            Cập nhật
                                        </a>
                                        <a onclick="return confirm('Bạn muốn XÓA Hình ảnh này? Hành động này sẽ không được hoàn tác.')" 
                                        class="btn btn-danger" href="{{ URL::to('/admin/del-gallery/'.$g->id_gallery) }}">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection
