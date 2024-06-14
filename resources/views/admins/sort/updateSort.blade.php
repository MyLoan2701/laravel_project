@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
            <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: inherit;">
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/show-all-sort')}}">Tất cả Lọc</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết Lọc</li>
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
                $warn = Session::get('warning');
                    if ($warn) {
                        echo '<div class="alert-t alert-danger">' . $warn . '</div>';
                        Session::put('warning', null);
                    }
                ?>
                <div class="position-center update">
                    <div class="detail-item">
                        <h3 class="text-center" style="padding: 10px;">Chi tiết Lọc</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">Mã Lọc: </span> <span>{{ $sort->id_sort }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Mô tả: </span><span>
                                @if($sort->description_sort == '')
                                (Chưa cập nhật...)
                                @else
                                {{ $sort->description_sort }}
                                @endif
                            </span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Href: </span><span>{{ $sort->href_sort }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Giá trị bắt đầu: </span><span>{{ $sort->from_sort }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Giá trị kết thúc: </span><span>{{ $sort->to_sort }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày tạo: </span><span>{{ $sort->created_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày cập nhật cuối: </span><span>{{ $sort->updated_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Thuộc: </span>
                                <span>
                                {{$sort->brand->name_brand}}
                                </span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Trạng thái: </span>
                                <span>
                                    <?php
                                    if ($sort->status_sort == 0) {
                                        echo 'Hoạt động';
                                    } elseif ($sort->status_sort == 1) {
                                        echo 'Dừng hoạt động';
                                    }
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    @hasrole(['Admin', 'Author'])
                    <div class="edit-item">
                        <h3 class="text-center" style="padding: 10px;">Cập nhật loại sản phẩm</h3>
                        <form role="form" action="{{ URL::to('/admin/update-sort/'.$sort->id_sort) }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-sort">Tên Sắp Xếp (Lọc)</label>
                            <input type="text" name="name_sort" class="form-control" value="{{$sort->name_sort}}">
                        </div>
                        <div class="form-group">
                            <label for="href-sort">Đường dẫn</label>
                            <input type="text" name="href_sort" class="form-control" value="{{$sort->href_sort}}">
                        </div>
                        <div class="form-group">
                            <label for="from-sort">Giá trị bắt đầu</label>
                            <input type="number" name="from_sort" class="form-control" value="{{$sort->from_sort}}">
                        </div>
                        <div class="form-group">
                            <label for="to-sort">Giá trị kết thúc</label>
                            <input type="number" name="to_sort" class="form-control" value="{{$sort->to_sort}}">
                        </div>
                        <div class="form-group">
                            <label for="description-sort">Mô tả</label>
                            <textarea class="form-control" name="description_sort" 
                            style="resize: vertical;">
                            <?php echo $sort->description_sort?>
                        </textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Dành cho loại sản phẩm</label>
                            <select class="form-control m-bot15" name="id_brand">
                            <option value="{{$sort->id_brand}}">{{$sort->brand->name_brand}}</option>
                                @foreach($brand as $b)
                                <option value="{{$b->id_brand}}">{{$b->name_brand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_sort">
                            @if ($sort->status_sort == 0)
                                    <option selected value="0">Hoạt động</option>
                                    <option value="1">Dừng hoạt động</option>
                                    @elseif($sort->status_sort == 1)
                                    <option value="0">Hoạt động</option>
                                    <option selected value="1">Dừng hoạt động</option>
                                    @endif
                            </select>
                        </div>
                        <button type="submit" name="update_sort" class="btn btn-info">Cập nhật</button>
                    </form>
                    </div>
                    @endhasrole
                </div>

            </div>
        </section>

    </div>
</div>
@endsection