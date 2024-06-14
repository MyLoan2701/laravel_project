@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
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
                    ?>
                    <form role="form" action="{{ URL::to('/admin/add-product') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name-product">Tên sản phẩm</label>
                            <input type="text" name="name_product" class="form-control" id="name-product" placeholder="Tên sản phẩm" required>
                        </div>
                        <div class="form-group">
                            <label for="slug-product">Slug</label>
                            <input type="text" name="slug_product" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price-product">Giá sản phẩm</label>
                            <input type="text" name="price_product" class="form-control money-format" oninput="checkNumber(this)" 
                            data-price="add_price_buy" placeholder="Giá sản phẩm" required>
                            <div class="error-message" id="add_price_buy_error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <label for="priceOrigin-product">Giá gốc</label>
                            <input type="text" name="priceOrigin_product" class="form-control money-format" oninput="checkNumber(this)" 
                            data-price="add_price_origin" placeholder="Giá gốc" required>
                            <div class="error-message" id="add_price_origin_error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <label for="sale-product">Giảm giá</label>
                            <input type="number" name="sale_product" class="form-control" id="sale-product" 
                            placeholder="Phần trăm giá ưu đãi sản phẩm" value="0">
                        </div>
                        <div class="form-group">
                            <label for="stock-product">Số lượng hàng trong kho</label>
                            <input type="number" name="stock_product" class="form-control" id="stock-product" 
                            placeholder="Số lượng sản phẩm có trong kho" value="100">
                        </div>
                        <div class="form-group">
                            <label for="description_product">Mô tả sản phẩm</label>
                            <textarea class="form-control " id="description_product" name="description_product" 
                            style="resize: vertical;" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="info_product">Thông tin sản phẩm</label>
                            <textarea class="form-control " id="info_product" name="info_product" 
                            style="resize: vertical;" placeholder="Thông tin sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh sản phẩm</label>
                            <input type="file" id="exampleInputFile" name="img_product" accept="image/*">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <input type="hidden" name="id_brand" value="{{$brand}}">
                        <div class="form-group">
                            <label for="inputSuccess">Danh mục sản phẩm</label>
                            <select class="form-control m-bot15" name="id_category">
                                @foreach( $category as $key => $c)
                                <option value="{{$c->id_category}}">{{$c->name_category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Lọai sản phẩm</label>
                            <select class="form-control m-bot15" name="type_product">
                                @foreach( $parent as $key => $pr)
                                <option value="{{$pr->id_brand}}">{{$pr->name_brand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess">Trạng thái</label>
                            <select class="form-control m-bot15" name="status_product">
                                <option value="0">Hoạt động</option>
                                <option value="1">Dừng hoạt động</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="release-product">Ngày phát hành</label>
                            <input type="date" name="release_product" class="form-control" id="release-product">
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
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
    .create(document.querySelector('#description_product'))
    .catch(error => {
        console.error(error);
    });
</script>
<script>
    ClassicEditor
    .create(document.querySelector('#info_product'))
    .catch(error => {
        console.error(error);
    });
</script>
@endsection