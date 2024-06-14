@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Tất cả Bài viết
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('message');
        if ($mess) {
            echo '<div class="alert-t alert-success" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('message', null);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="tableAllPost">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã Bài viết</th>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Mục bài viết</th>
                        <th>Trạng thái</th>
                        <th>Chi Tiết</th>
                        @hasrole(['Admin', 'Author'])
                        <th style="width:30px;">Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($post as $key => $p)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $p->id_post }}</td>
                        <td><img src="{{ URL::to('public/upload/post/'.$p->avatar_post) }}" alt="{{$p->avatar_post}}" width="150px" height="90"></td>
                        <td>
                            <b>{{ $p->name_post }}</b>
                            <p>{{ $p->author_post }}</p>
                            <p>{{$p->created_at}}</p>
                        </td>
                        <td>{{$p->type->name_typePost}}</td>
                        <td>
                            <?php
                            if ($p->status_post == 0) {
                                echo '<span class="text-success">Hoạt động</span>';
                            } else {
                                echo '<span class="text-danger">Dừng hoạt động</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::to('/admin/show-detail-post/'.$p->id_post) }}">
                                Chi tiết
                            </a>
                        </td>
                        @hasrole(['Admin', 'Author'])
                        <td>
                            <a onclick="return confirm('Bạn muốn XÓA sản phẩm này? Hành động này sẽ không được hoàn tác.')" 
                            href="{{ URL::to('/admin/del-post/'.$p->id_post) }}" >
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                        @endhasrole
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection