@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Bài viết
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php

                    use Illuminate\Support\Facades\Session;
                    use Illuminate\Support\Facades\Auth;

                    $mess = Session::get('message');
                    if ($mess) {
                        echo '<div class="alert-t alert-success">' . $mess . '</div>';
                        Session::put('message', null);
                    }
                    ?>
                    <form role="form" action="{{ URL::to('/admin/add-post') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-post">Tên Bài viết</label>
                            <input type="text" name="name_post" class="form-control" placeholder="Tên Bài viết" required>
                        </div>
                        <div class="form-group">
                            <label for="slug-post">Slug</label>
                            <input type="text" name="slug_post" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content_post">Nội dung Bài viết</label>
                            <textarea class="form-control " id="content_post" name="content_post" 
                            style="resize: vertical;" placeholder="Nội dung Bài viết"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh sản phẩm</label>
                            <input type="file" id="exampleInputFile" name="img_post">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="form-group">
                            <label for="author-post">Tác giả</label>
                            <input type="text" name="author_post" class="form-control" value="{{Auth::user()->name_admin}}" required>
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
                            <label for="inputSuccess">Liên kết sản phẩm (nếu có)</label>
                            <select class="form-control m-bot15" name="link_post">
                                <option value="0">---Chọn liên kết sản phẩm---</option>
                                @foreach($product as $p)
                                <option value="{{$p->id_product}}">{{$p->name_product}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_post">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_post" class="btn btn-info">Thêm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection

@section('js-custom')
<script>
    ClassicEditor
    .create(document.querySelector('#content_post'))
    .catch(error => {
        console.error(error);
    });
</script>
@endsection