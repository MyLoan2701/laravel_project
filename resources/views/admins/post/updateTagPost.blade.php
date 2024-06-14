@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
            <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: inherit;">
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/show-add-tag-post')}}">Tất cả Mục Bài viết</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa Mục bài viết</li>
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
                    <form role="form" action="{{ URL::to('/admin/update-tag-post/'.$post->id_typePost) }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-post">Tên Mục Bài viết</label>
                            <input type="text" name="name_typePost" class="form-control" value="{{$post->name_typePost}}" required>
                        </div>
                        <div class="form-group">
                            <label for="slug-post">Slug</label>
                            <input type="text" name="slug_typePost" class="form-control" value="{{$post->slug_typePost}}">
                        </div>
                        <div class="form-group">
                            <label for="description_typePost">Mô tả</label>
                            <textarea class="form-control " name="description_typePost" style="resize: vertical;">{{$post->description_typePost}} </textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_typePost">
                                @if ($post->status_typePost == 0)
                                <option selected value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                                @elseif($post->status_typePost == 1)
                                <option value="0">Hoạt động</option>
                                <option selected value="1">Dừng hoạt động</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="update_typePost" class="btn btn-info">Cập nhật</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection