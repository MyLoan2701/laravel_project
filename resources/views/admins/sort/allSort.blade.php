@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Tất cả điều kiện sắp xếp(Lọc)
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('warning');
        if ($mess) {
            echo '<div class="alert-t alert-warning" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('warning', null);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="tableAllSort">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã lọc</th>
                        <th>Thông tin</th>
                        <th>Mô tả</th>
                        <th>Thuộc</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                        @hasrole(['Admin', 'Author'])
                        <th>Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($sort as $key => $s)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$s->id_sort}}</td>
                        <td>
                            <p><b>Tên:</b> {{$s->name_sort}}</p>
                            <p><b>Href:</b> {{$s->href_sort}}</p>
                            <p><b>Giá trị bắt đâu:</b> {{$s->from_sort}}</p>
                            <p><b>Giá trị kết thúc:</b> {{$s->to_sort}}</p>
                        </td>
                        <td>
                            @if($s->description_sort == '')
                            <p style="font-style: italic;">(Chưa cập nhật...)</p>
                            @else
                            @echo $s->description
                            @endif
                        </td>
                        <td>{{$s->brand->name_brand}}</td>
                        <td>
                            <?php
                            if ($s->status_sort == 0) {
                                echo '<span class="text-success">Hoạt động</span>';
                            } else {
                                echo '<span class="text-danger">Dừng hoạt động</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::to('/admin/show-edit-sort/'.$s->id_sort) }}">
                                Chi tiết
                            </a>
                        </td>
                        @hasrole(['Admin', 'Author'])
                        <td>
                            <a onclick="return confirm('Bạn muốn XÓA Lọc này? Hành động này sẽ không được hoàn tác.')" 
                            href="{{ URL::to('/admin/del-sort/'.$s->id_sort) }}" >
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