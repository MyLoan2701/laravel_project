@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chi tiết loại sản phẩm
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
                        <h3 class="text-center" style="padding: 10px;">Chi tiết loại sản phẩm</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">Mã loại sản phẩm: </span> <span>{{ $brand->id_brand }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Mô tả: </span><span>{{ $brand->description_brand }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Slug: </span><span>{{ $brand->slug_brand }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Từ khóa: </span><span>{{ $brand->key_brand }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày tạo: </span><span>{{ $brand->created_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày cập nhật cuối: </span><span>{{ $brand->updated_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Thuộc: </span>
                                <span>
                                    <?php
                                    if ($brand->parent_brand == 0) {
                                        echo 'Không thuộc mục Cha nào';
                                    } else {
                                        foreach ($parent as $p) {
                                            if ($p->id_brand == $brand->parent_brand) {
                                                echo $p->name_brand;
                                                break;
                                            }
                                        }
                                    }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Trạng thái: </span>
                                <span>
                                    <?php
                                    if ($brand->status_brand == 0) {
                                        echo 'Hoạt động';
                                    } elseif ($brand->status_brand == 1) {
                                        echo 'Dừng hoạt động';
                                    }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Số lượng sản phẩm thuộc loại này: </span></li>
                        </ul>
                    </div>
                    @hasrole(['Admin', 'Author'])
                    <div class="edit-item">
                        <h3 class="text-center" style="padding: 10px;">Cập nhật loại sản phẩm</h3>
                        <form role="form" action="{{ URL::to('/admin/update-brand/'.$brand->id_brand) }}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name-brand">Tên loại sản phẩm</label>
                                <input type="text" name="name_brand" class="form-control" placeholder="Tên loại sản phẩm" value="{{ $brand->name_brand }}">
                            </div>
                            <div class="form-group">
                                <label for="slug-brand">Slug</label>
                                <input type="text" name="slug_brand" class="form-control" value="{{ $brand->slug_brand }}">
                            </div>
                            <div class="form-group">
                                <label for="description-brand">Mô tả loại sản phẩm</label>
                                <textarea class="form-control " id="description-brand" name="description_brand" style="resize: vertical;" placeholder="Mô tả loại sản phẩm">{{ $brand->description_brand }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="key-brand">Từ khóa</label>
                                <input type="text" name="key_brand" class="form-control" value="{{ $brand->key_brand }}">
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Thuộc loại</label>
                                <select class="form-control m-bot15" name="parent_brand">
                                    <option value="{{$brand->parent_brand}}">
                                        <?php
                                        if ($brand->parent_brand == 0) {
                                            echo 'Loại mục bậc Cha';
                                        } else {
                                            foreach ($parent as $p) {
                                                if ($p->id_brand == $brand->parent_brand) {
                                                    echo $p->name_brand;
                                                    break;
                                                }
                                            }
                                        }
                                        ?>
                                    </option>

                                    @foreach($parent as $br)
                                    <option value="{{$br->id_brand}}">{{$br->name_brand}}</option>
                                    @endforeach
                                    <option value="0">---Loại mục bậc 'Cha'---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Trạng thái</label>
                                <select class="form-control m-bot15" name="status_brand">
                                    @if ($brand->status_brand == 0)
                                    <option selected value="0">Hoạt động</option>
                                    <option value="1">Dừng hoạt động</option>
                                    @elseif($brand->status_brand == 1)
                                    <option value="0">Hoạt động</option>
                                    <option selected value="1">Dừng hoạt động</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="add_brand" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                    @endhasrole
                </div>

            </div>
        </section>

    </div>
</div>
@endsection