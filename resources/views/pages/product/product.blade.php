@extends('layouts.layoutC2')
@section('content')

<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

$name = Session::get('name');
$id_client = Session::get('id_client');
$email_client = Session::get('email_client');

$content = Cart::content();
?>


<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{URL::to('/brand/'.$product->brand->slug_brand)}}">{{$product->brand->name_brand}}</a></li>
            <li class="breadcrumb-item"><a href="{{URL::to('/category/'.$product->category->slug_category)}}">{{$product->category->name_category}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$product->name_product}}</li>
        </ol>
    </nav>
</div>
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <ul id="imageGallery">
            <li data-thumb="{{asset('public/upload/product/'.$product->img_product)}}" data-src="{{asset('public/upload/product/'.$product->img_product)}}">
                <img src="{{asset('public/upload/product/'.$product->img_product)}}" alt="{{$product->name_product}}" class="img-gallery" 
                id="wishlist_product_img_{{$product->id_product}}"/>
            </li>
            @if(isset($gallery))
            @foreach($gallery as $g)
            <li data-thumb="{{asset('public/upload/gallery/'.$g->img_gallery)}}" data-src="{{asset('public/upload/gallery/'.$g->img_gallery)}}">
                <img src="{{asset('public/upload/gallery/'.$g->img_gallery)}}" alt="{{$g->name_gallery}}" class="img-gallery" />
            </li>
            @endforeach
            @endif
        </ul>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{URL::to('/public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
            <h2>{{$product->name_product}}</h2>
            <p>Mã sản phẩm: {{$product->id_product}}</p>
            <?php if ($product->sale_product > 0) {?>
            <p class="price-old" style="display: none;" id="wishlist_product_price_old_{{$product->id_product}}">{{number_format($product->priceOld_product)}}₫</p>
            <span class="sale-product" style="display: none;" id="wishlist_product_sale_{{$product->id_product}}">-{{$product->sale_product}}₫</span>
            <?php }?>
            

            <form>
                {{csrf_field()}}
                <span>
                    <span>{{number_format($product->price_product)}}đ</span>
                    <label>Số lượng:</label>
                    <input type="number" min="1" value="1" name="qty" class="cart-product-qty-{{$product->id_product}}" oninput="checkStockProduct(this.value, <?php echo $product->stock2_product ?>)" min="1" max="5" />
                    <input name="id_pd" type="hidden" value="{{$product->id_product}}" class="cart-product-id-{{$product->id_product}}" />
                    <input type="hidden" value="{{$product->price_product}}" name="price" class="cart-product-price-{{$product->id_product}}">
                    <input type="hidden" value="{{$product->stock2_product}}" name="stock" class="cart-product-stock-{{$product->id_product}}">
                    <input type="hidden" value="{{$product->name_product}}" name="name" class="wishlist-product-name-{{$product->id_product}}">
                    <?php
                    if ($product->status_product == 0) {
                        if ($content) {
                            foreach ($content as $ct) {
                                if ($ct->id == $product->id_product) { ?>
                                    <input type="hidden" name="qty_cart" value="{{$ct->qty}}" class="cart-product-qty-cart-{{$product->id_product}}">
                                <?php
                                    break;
                                } else { ?>
                                    <input type="hidden" name="qty_cart" value="" class="cart-product-qty-cart-{{$product->id_product}}">
                        <?php }
                            }
                        } ?>
                        <button type="button" class="btn btn-default cart add-to-cart" id="add-cart-block" name="add-to-cart" data-id="{{$product->id_product}}">
                            <i class="fa fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                        </button>
                    <?php
                    } elseif ($product->status_product == 1) { ?>
                        <input type="button" value="Ngừng kinh doanh" class="btn btn-default cart add-to-cart" disabled style="height: auto;width: max-content;">
                    <?php
                    }
                    ?>
                </span>
            </form>

            <p class="text-alert" id="warning-stock"></p>
            <p><b>Tình trạng:</b>
                <?php
                if ($product->status_product == 0) {
                    echo $retVal = ($product->stock2_product > 0) ? 'Còn hàng' : 'Đã hết hàng. Vui lòng đợi cập nhật.';
                } elseif ($product->status_product == 1) {
                    echo "Sản phẩm hiện tại đã ngừng kinh doanh.";
                }
                ?></p>
            <p><b>Điểu kiện:</b> Mới 100%</p>
            <p><b>Loại sản phẩm:</b> {{$product->brand->name_brand}}</p>
            <p><b>Hãng:</b> {{$product->category->name_category}}</p>
            <a href=""><img src="{{URL::to('public/frontend/images/share.png')}}" class="share img-responsive" alt="" /></a>
            <a href="{{ URL::to('/product/'.$product->slug_product)}}" id="wishlist_product_url_{{$product->id_product}}" die class="disable"></a>
            <button class="button-wishlist" id="{{$product->id_product}}_wishlist" onclick="addWishlist(this.id);"
            style="font-size: 16px;">
            <span id="wishlist_span_detail_product"><i class="fas fa-heart"></i> Thêm vào Yêu Thích</span></button>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá ({{$count}})</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details">
            <div class="info-p">
                <h3>Thông tin sản phẩm</h3>
                <div class="box-info">
                    <?php if ($product->info_product == '') {
                        echo "(Đàng chờ cập nhật...)";
                    } else {
                        echo $product->info_product;
                    } ?>
                </div>
            </div>
            <div class="des-p">
                <h3>Mô tả sản phẩm</h3>
                <div class="box-info"><?php if ($product->description_product == '') {
                                            echo "(Đang chờ cập nhật...)";
                                        } else echo $product->description_product ?></div>
            </div>
        </div>

        <div class="tab-pane fade" id="reviews">
            <div class="col-sm-12 list-comment">
                @foreach($comment as $cm)
                <div class="row item-comment">
                    <div class="col-md-2 avatar-user-comment text-center">
                        <img src="{{URL::to('public/frontend/images/avatar-default.jpg')}}" alt=""
                        class="img img-responsive img-thumbnail" width="100" height="100">
                    </div>
                    <div class="col-md-10 info-comment">
                        <ul>
                            <li><i class="fa fa-user"></i>{{$cm->name_comment}}</li>
                            <li> -  <i class="fa-solid fa-calendar-days"></i>{{$cm->created_at}}</li>
                        </ul>
                        <div class="content-comment" style="padding: 0 0 10px;">
                            <?php echo $cm->content_comment ?>
                        </div>
                        @if($cm->rep_comment != '')
                        <div class="rep-content-comment">
                            <?php echo $cm->rep_comment ?>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                @if($count == 0)
                <div style="text-align: center; font-size: larger; font-style: italic;">Chưa có bình luận nào. Hãy là người đầu tiên bình luận sản phẩm này.</div>
                @endif
                <div class="write-comment">
                    <p><b>Viết Bình Luận Của Bạn</b></p>

                    <form>
                        {{csrf_field()}}
                        <span>
                            <input type="text" placeholder="Tên" name="name_comment" 
                            value="<?php if(isset($name)) echo $name?>" required class="name-comment"/>
                            <input type="email" placeholder="Địa chỉ Email" name="email_comment" 
                            value="<?php if(isset($email_client)) echo $email_client?>" class="email-comment" required/>
                            <input type="hidden" name="id_client" value="<?php if(isset($id_client)) echo $id_client?>"
                            class="id-client-comment">
                            <input type="hidden" name="id_product" value="{{$product->id_product}}" required
                            class="id-product-comment">
                        </span>
                        <textarea name="content_comment" class="content-comment-2" required></textarea>
                        <button type="button" class="btn btn-default pull-right submit-comment">Gửi</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($relate_product as $key => $rp)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('/public/upload/product/'.$rp->img_product)}}" alt="$rp->img_product" width="70%" />
                                <h2>{{$rp->price_product}}</h2>
                                <p>{{$rp->name_product}}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div><!--/recommended_items-->


@endsection