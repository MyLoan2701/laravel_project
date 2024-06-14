@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh mục sản phẩm
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
            <table class="table table-striped b-t b-light" id="tableAllCategory">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã Danh Mục</th>
                        <th>Ảnh</th>
                        <th>Tên Danh Mục</th>
                        <th>Loại danh mục</th>
                        <th>Trạng thái</th>
                        <th>Chi Tiết</th>
                        @hasrole(['Admin', 'Author'])
                        <th style="width:30px;">Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_category as $key => $category)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $category->id_category }}</td>
                        <td><img src="{{ URL::to('public/upload/category/'.$category->img_category) }}" alt="{{$category->img_category}}" width="150px"></td>
                        <td>{{ $category->name_category }}</td>
                        <td>{{ $category->brand->name_brand }}</td>
                        <td class="text-primary">
                            <?php
                            if ($category->status_category == 0) {
                                echo 'Hoạt động';
                            } else {
                                echo 'Dừng hoạt động';
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::to('/admin/edit-category-product/'.$category->id_category) }}">
                                Chi tiết
                            </a>
                        </td>
                        @hasrole(['Admin', 'Author'])
                        <td>
                            <a href="#del-categoryP" data-toggle="modal">
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                        @endhasrole
                    </tr>

                    <!-- #del-categoryP (Xóa danh mục sản phẩm) -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="del-categoryP" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h3 class="modal-title text-center">Bạn muốn xóa danh mục này?</h3>
                                    <p class="text-muted text-center font-italic">(Hành động này sẽ không được hoàn tác.)</p>
                                </div>
                                <div class="modal-body div-center">
                                    <form class="form-inline" role="form" action="{{ URL::to('/admin/del-category-product/'.$category->id_category) }}">
                                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /#del-categoryP (Xóa danh mục sản phẩm) -->
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection