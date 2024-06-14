@extends('homeA')
@section('adminContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: inherit;">
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin/show-all-product')}}">Tất cả Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết Sản phẩm</li>
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
                ?>
                <div class="position-center update">
                    <div class="detail-item">
                        <h3 class="text-center" style="padding: 10px;">Chi tiết Sản phẩm</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><span><img src="{{ URL::to('public/upload/product/'.$product->img_product) }}" alt="{{$product->img_product}}" width="50px"></span> <span>{{ $product->name_product }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Mã sản phẩm: </span><span>{{ $product->id_product }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Trạng thái: </span>
                                <span>
                                    <?php
                                    if ($product->status_product == 0) {
                                        echo 'Hoạt động';
                                    } elseif ($product->status_product == 1) {
                                        echo 'Dừng hoạt động';
                                    }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Danh mục: </span><span>{{ $product->category->name_category }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Loại Sản phẩm: </span>
                                <span>
                                    {{ $product->brand->name_brand}} - {{$brand->name_brand}}
                                </span>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Giá sản phẩm: </span><span>{{ number_format($product->price_product)}}₫</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Giá gốc: </span><span>{{ number_format($product->priceOrigin_product)}}₫</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Giảm giá: </span><span>{{ $product->sale_product }}%</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Kho: </span><span>{{ $product->stock_product }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Đã bán: </span><span>{{ $product->sold_product }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày phát hành: </span><span>{{ $product->release_product }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Mô tả: </span>
                                <div class="box-info"><?php echo  $product->description_product ?></div>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Thông tin: </span>
                                <div class="box-info"><?php echo $product->info_product ?></div>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày tạo: </span><span>{{ $product->created_at }}</span></li>
                            <li class="list-group-item"><span class="font-weight-bold">Ngày cập nhật cuối: </span><span>{{ $product->updated_at }}</span></li>
                            <li class="list-group-item">
                                @if(isset($gallery))
                                @foreach($gallery as $g)
                                <span><img src="{{ URL::to('public/upload/gallery/'.$g->img_gallery) }}" alt="{{$g->name_gallery}}" width="50px" style="border: 1px solid #000;"></span>
                                @endforeach
                                @endif
                            </li>
                        </ul>
                    </div>
                    @hasrole(['Admin', 'Author'])
                    <div class="edit-item">
                        <h3 class="text-center" style="padding: 10px;">Cập nhật Sản phẩm</h3>
                        <form role="form" action="{{ URL::to('/admin/update-product/'.$product->id_product) }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name-product">Tên sản phẩm</label>
                                <input type="text" name="name_product" class="form-control" placeholder="Tên sản phẩm" value="{{ $product->name_product }}">
                            </div>
                            <div class="form-group">
                                <label for="slug-product">Slug</label>
                                <input type="text" name="slug_product" class="form-control" value="{{ $product->slug_product }}">
                            </div>
                            <div class="form-group">
                                <label for="price-product">Giá sản phẩm</label>
                                <input type="text" name="price_product" class="form-control money-format price-buy" oninput="checkNumber(this)"
                                data-price="edit_price_buy" placeholder="Giá sản phẩm" value="{{ $product->priceOld_product }}">
                                <div class="error-message" id="edit_price_buy_error" style="color: red;"></div>
                            </div>
                            <div class="form-group">
                                <label for="priceOrigin-product">Giá gốc</label>
                                <input type="text" name="priceOrigin_product" class="form-control money-format price-origin" oninput="checkNumber(this)"
                                data-price="edit_price_origin" placeholder="Giá gốc" value="{{ $product->priceOrigin_product }}">
                                <div class="error-message" id="edit_price_origin_error" style="color: red;"></div>
                            </div>
                            <div class="form-group">
                                <label for="sale-product">Giảm giá</label>
                                <input type="number" name="sale_product" class="form-control" id="sale-product" placeholder="Phần trăm giá ưu đãi sản phẩm" value="{{ $product->sale_product }}">
                            </div>
                            <div class="form-group">
                                <label for="stock-product">Số lượng hàng trong kho</label>
                                <input type="number" name="stock_product" class="form-control" id="stock-product" placeholder="Số lượng sản phẩm có trong kho" value="{{ $product->stock_product }}">
                            </div>
                            <div class="form-group">
                                <label for="description-product2">Mô tả sản phẩm</label>
                                <textarea class="form-control " id="description-product2" name="description_product" style="resize: vertical;" placeholder="Mô tả sản phẩm">{{ $product->description_product }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="info-product2">Thông tin sản phẩm</label>
                                <textarea class="form-control " id="info-product2" name="info_product" style="resize: vertical;" placeholder="Thông tin sản phẩm">{{ $product->info_product }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ảnh sản phẩm</label>
                                <input type="file" id="exampleInputFile" name="img_product" accept="image/*">
                                <p class="help-block">Example block-level help text here.</p>
                                <img src="{{ URL::to('public/upload/product/'.$product->img_product) }}" alt="{{$product->img_product}}" width="50px">
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Danh mục sản phẩm</label>
                                <select class="form-control m-bot15" name="id_category">
                                    @foreach( $category as $key => $c)
                                    @if ($c->id_category == $product->id_category)
                                    <option selected value="{{$c->id_category}}">{{$c->name_category}}</option>
                                    @else
                                    <option value="{{$c->id_category}}">{{$c->name_category}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Lọai sản phẩm</label>
                                <select class="form-control m-bot15" name="type_product">
                                    @foreach( $parent as $key => $pr)
                                    @if ($pr->id_brand == $product->type_brand_product)
                                    <option selected value="{{$pr->id_brand}}">{{$pr->name_brand}}</option>
                                    @else
                                    <option value="{{$pr->id_brand}}">{{$pr->name_brand}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess">Trạng thái</label>
                                <select class="form-control m-bot15" name="status_product">
                                    @if ($product->status_product == 0)
                                    <option selected value="0">Hoạt động</option>
                                    <option value="1">Dừng hoạt động</option>
                                    @elseif($product->status_product == 1)
                                    <option value="0">Hoạt động</option>
                                    <option selected value="1">Dừng hoạt động</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="release-product">Ngày phát hành</label>
                                <input type="date" name="release_product" class="form-control" id="release-product">
                            </div>
                            <button type="submit" name="update_product" class="btn btn-info">Cập nhật</button>
                            <a href="{{URL::to('/admin/show-add-gallery/'. $product->id_product)}}" class="btn btn-warning">Thêm thư viện ảnh</a>
                        </form>
                    </div>
                    @endhasrole
                </div>

            </div>
        </section>

    </div>
</div>
@endsection

@section('js-custom')
<script>
    ClassicEditor
        .create(document.querySelector('#description-product2'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#info-product2'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection