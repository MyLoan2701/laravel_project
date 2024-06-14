@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Tất cả sản phẩm
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
            <table class="table table-striped b-t b-light" id="tableAllProduct">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã Sản Phẩm</th>
                        <th>Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Hãng</th>
                        <th>Giá</th>
                        <th>Kho</th>
                        <th>Bán</th>
                        <th>Trạng thái</th>
                        <th>Chi Tiết</th>
                        @hasrole(['Admin', 'Author'])
                        <th style="width:30px;">Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_product as $key => $product)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $product->id_product }}</td>
                        <td><img src="{{ URL::to('public/upload/product/'.$product->img_product) }}" alt="{{$product->img_product}}" width="50px"></td>
                        <td>{{ $product->name_product }}</td>
                        <td>{{ $product->category->name_category }}</td>
                        <td class="money-format">{{ $product->price_product }}</td>
                        <td>{{ $product->stock_product }}</td>
                        <td style="color: #0088ff;">{{ $product->sold_product }}</td>
                        <td>
                            <?php
                            if ($product->status_product == 0) {
                                echo '<span class="text-success">Hoạt động</span>';
                            } else {
                                echo '<span class="text-danger">Dừng hoạt động</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::to('/admin/show-edit-product/'.$product->id_product) }}">
                                Chi tiết
                            </a>
                        </td>
                        @hasrole(['Admin', 'Author'])
                        <td>
                            <a onclick="return confirm('Bạn muốn XÓA sản phẩm này? Hành động này sẽ không được hoàn tác.')" 
                            href="{{ URL::to('/admin/del-product/'.$product->id_product) }}" >
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                        @endhasrole
                    </tr>

                    <!-- #del-productP (Xóa Sản Phẩm sản phẩm) -->
                    <!-- <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="del-product" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h3 class="modal-title text-center">Bạn muốn xóa Sản Phẩm này?</h3>
                                    <p class="text-muted text-center font-italic">(Hành động này sẽ không được hoàn tác.)</p>
                                </div>
                                <div class="modal-body div-center">
                                    <form class="form-inline" role="form" action="{{ URL::to('/admin/del-product/'.$product->id_product) }}">
                                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div> -->
                    <!-- /#del-productP (Xóa Sản Phẩm sản phẩm) -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection