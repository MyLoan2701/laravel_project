@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: inherit;">
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/show-all-post')}}">Tất cả Bài viết</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/show-detail-post/'.$post->id_post)}}">Xem chi tiết bài viết</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa bài viết</li>
                    </ol>
                </nav>
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
                    @hasrole(['Admin', 'Author'])
                    <div class="edit-item">
                        <h3 class="text-center" style="padding: 10px;">Chỉnh sửa Bài viết</h3>
                        <form role="form" action="{{ URL::to('/admin/update-post/'.$post->id_post) }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name-post">Tên Bài viết</label>
                                <input type="text" name="name_post" class="form-control" value="{{$post->name_post}}">
                            </div>
                            <div class="form-group">
                                <label for="slug-post">Slug</label>
                                <input type="text" name="slug_post" class="form-control" value="{{$post->slug_post}}">
                            </div>
                            <div class="form-group">
                                <label for="content_post2">Nội dung Bài viết</label>
                                <textarea class="form-control " id="content_post2" name="content_post" style="resize: vertical;">{{$post->content_post }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ảnh sản phẩm</label>
                                <input type="file" id="exampleInputFile" name="img_post">
                                <p class="help-block">Example block-level help text here.</p>
                                <img src="{{ URL::to('public/upload/post/'.$post->avatar_post) }}" alt="{{$post->avatar_post}}" width="100px">
                            </div>
                            <div class="form-group">
                                <label for="author-post">Tác giả</label>
                                <input type="text" name="author_post" class="form-control" value="{{$post->author_post}}">
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Mục bài viết</label>
                                <select class="form-control m-bot15" name="tag_post">
                                    <option value="0">---Chọn mục cho bài viết---</option>
                                    @foreach($type as $t)
                                    <option value="{{$t->id_typePost}}">{{$t->name_typePost}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Trạng thái</label>
                                <select class="form-control m-bot15" name="status_post">
                                    @if ($post->status_post == 0)
                                    <option selected value="0">Hoạt động</option>
                                    <option value="1">Dừng hoạt động</option>
                                    @elseif($post->status_post == 1)
                                    <option value="0">Hoạt động</option>
                                    <option selected value="1">Dừng hoạt động</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="update_post" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                    @endhasrole
                </div>

            </div>
        </section>

    </div>
</div>
@endsection

@section('js-custom')
<script>
    ClassicEditor
        .create(document.querySelector('#content_post2'), {
            ckfinder:
            {
                uploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token()])}}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection