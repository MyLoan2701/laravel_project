@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Banner
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('message');
        if ($mess) {
            echo '<div class="alert-t alert-success" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('message', null);
        }
        ?>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã Banner</th>
                        <th>Tên Banner</th>
                        <th>Ảnh</th>
                        <th>Trạng thái</th>
                        <th>Chi Tiết</th>
                        @hasrole(['Admin', 'Author'])
                        <th style="width:30px;">Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_banner as $key => $banner)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $banner->id_banner }}</td>
                        <td>{{ $banner->name_banner }}</td>
                        <td><img src="{{ URL::to('public/upload/banner/'.$banner->img_banner) }}" alt="{{$banner->img_banner}}" width="150px"></td>
                        <td class="text-primary">
                            <?php
                            if ($banner->status_banner == 0) {
                                echo 'Hoạt động';
                            } else {
                                echo 'Dừng hoạt động';
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::to('/admin/show-edit-banner/'.$banner->id_banner) }}">
                                Chi tiết
                            </a>
                        </td>
                        @hasrole(['Admin', 'Author'])
                        <td>
                            <a onclick="return confirm('Bạn muốn XÓA Banner này? Hành động này sẽ không được hoàn tác.')" href="{{ URL::to('/admin/del-banner/'.$banner->id_banner) }}">
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                        @endhasrole
                    </tr>


                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection