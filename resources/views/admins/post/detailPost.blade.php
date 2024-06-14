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
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết Bài viết</li>
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
                    <div class="detail-item">
                        <h3 class="text-center" style="padding: 10px;">Chi tiết Bài viết</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><span><img src="{{ URL::to('public/upload/post/'.$post->avatar_post) }}" alt="{{$post->avatar_post}}" width="150px"></span> </li>
                            <li class="list-group-item"><span class="font-weight-bold">Mã bài viết: </span><span>{{ $post->id_post }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Tiêu đề bài viết: </span><span>{{ $post->name_post }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Trạng thái: </span>
                                <span>
                                    <?php
                                    if ($post->status_post == 0) {
                                        echo 'Hoạt động';
                                    } elseif ($post->status_post == 1) {
                                        echo 'Dừng hoạt động';
                                    }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Tác giả: </span><span>{{ $post->author_post }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Người đăng bài: </span> <span>{{ $post->poster_post}}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày tạo: </span><span>{{ $post->created_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày cập nhật cuối: </span><span>{{ $post->updated_at }}</span></li>
                        </ul>
                        <h3 class="text-center" style="padding: 10px;">Nội dung Bài viết</h3>
                        <div class="content-post">
                            <div class="box-info" style="background-color: white;"><?php echo $post->content_post ?></div>
                        </div>
                        <div class="text-center">
                            <a class="btn btn-info" href="{{ URL::to('/admin/preview-page-post/'.$post->id_post) }}">
                                Xem trước trang
                            </a>
                            @hasrole(['Admin', 'Author'])
                            <a class="btn btn-warning" href="{{ URL::to('/admin/show-edit-post/'.$post->id_post) }}">
                                Chỉnh sửa
                            </a>
                            @endhasrole
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection
