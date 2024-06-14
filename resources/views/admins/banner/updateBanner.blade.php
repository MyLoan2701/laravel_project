@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chi tiết Banner
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
                        <h3 class="text-center" style="padding: 10px;">Chi tiết danh mục</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><img src="{{ URL::to('public/upload/banner/'.$banner->img_banner) }}" alt="{{$banner->img_banner}}" height="220px" width="720"></li>
                            <li class="list-group-item"><span class="font-weight-bold">Tên: </span><span>{{ $banner->name_banner }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Mô tả: </span><span>{{ $banner->description_banner }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày tạo: </span><span>{{ $banner->created_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày cập nhật cuối: </span><span>{{ $banner->updated_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Trạng thái: </span>
                                <span>
                                    <?php
                                    if ($banner->status_banner == 0) {
                                        echo 'Hoạt động';
                                    } elseif ($banner->status_banner == 1) {
                                        echo 'Dừng hoạt động';
                                    }
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    @hasrole(['Admin', 'Author'])
                    <div class="edit-item">
                        <h3 class="text-center" style="padding: 10px;">Cập nhật Banner</h3>
                        <form role="form" action="{{ URL::to('/admin/update-banner/'.$banner->id_banner) }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name-banner">Tên Banner</label>
                                <input type="text" name="name_banner" class="form-control" id="name-banner" 
                                placeholder="Tên mục sản phẩm" required value="{{ $banner->name_banner }}">
                            </div>
                            <div class="form-group">
                                <label for="description-banner">Mô tả Banner</label>
                                <textarea class="form-control " id="description-banner" 
                                name="description_banner" style="resize: vertical;" 
                                placeholder="Mô tả Banner">{{ $banner->description_banner }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ảnh Banner</label>
                                <input type="file" id="exampleInputFile" name="img_banner">
                                <p class="help-block">Example block-level help text here.</p>
                                <img src="{{ URL::to('public/upload/banner/'.$banner->img_banner) }}" alt="{{$banner->img_banner}}" width="100px">
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Trạng thái</label>
                                <select class="form-control m-bot15" name="status_banner">
                                    @if ($banner->status_banner == 0)
                                    <option selected value="0">Hoạt động</option>
                                    <option value="1">Dừng hoạt động</option>
                                    @elseif($banner->status_banner == 1)
                                    <option value="0">Hoạt động</option>
                                    <option selected value="1">Dừng hoạt động</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="update_banner" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                    @endhasrole
                </div>

            </div>
        </section>

    </div>
</div>
@endsection