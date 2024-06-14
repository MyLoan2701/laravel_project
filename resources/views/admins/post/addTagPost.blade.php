@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Mục Bài Viết
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
                    <form role="form" action="{{ URL::to('/admin/add-tag-post') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-post">Tên Mục Bài viết</label>
                            <input type="text" name="name_typePost" class="form-control" placeholder="Tên Bài viết" required>
                        </div>
                        <div class="form-group">
                            <label for="slug-post">Slug</label>
                            <input type="text" name="slug_typePost" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description_typePost">Mô tả</label>
                            <textarea class="form-control " id="description_typePost" name="description_typePost" style="resize: vertical;"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_typePost">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" name="add_typePost" class="btn btn-info">Thêm</button>
                    </form>
                </div>
                <div class="table-delivery">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light" id="tableAllTagPost">
                            <thead>
                                <tr>
                                    <th style="width:20px;">
                                        <label class="i-checks m-b-none">
                                            <input type="checkbox"><i></i>
                                        </label>
                                    </th>
                                    <th>Mã (ID)</th>
                                    <th>Mục bài viết</th>
                                    <th>Slug</th>
                                    <th width="35%">Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th>Nút</th>
                                </tr>
                            </thead>
                            <tbody id="load-tag-post">
                                @foreach($typeP as $t)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                    <td>{{$t->id_typePost}}</td>
                                    <td>{{$t->name_typePost}}</td>
                                    <td>{{$t->slug_typePost}}</td>
                                    <td>
                                        @if($t->description_typePost == '')
                                        <span style="font-style: italic;">(Chưa cập nhật)</span>
                                        @else
                                        {{$t->description_typePost}}
                                        @endif
                                    </td>
                                    <td><?php
                                        if ($t->status_typePost == 0) {
                                            echo '<span class="text-success">Hoạt động</span>';
                                        } else {
                                            echo '<span class="text-danger">Dừng hoạt động</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ URL::to('/admin/show-edit-tag-post/'.$t->id_typePost) }}">
                                            Cập nhật
                                        </a>
                                        <a class="btn btn-danger" href="{{ URL::to('/admin/del-tag-post/'.$t->id_typePost) }}">
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