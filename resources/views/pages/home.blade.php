@extends('layouts.layoutC1')
@section('content')

<?php

use Gloudemans\Shoppingcart\Facades\Cart;

$content = Cart::content();
?>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới</h2>
    @foreach($product as $key => $p)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <a href="{{ URL::to('/product/'.$p->slug_product)}}" class="link_product" id="wishlist_product_url_{{$p->id_product}}">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/upload/product/'.$p->img_product)}}" alt="{{$p->img_product}}" id="wishlist_product_img_{{$p->id_product}}" />
                        <p class="name-product">{{$p->name_product}}</p>
                        <?php
                        if ($p->sale_product > 0) { ?>
                            <div class="box-p">
                                <p class="price-old" id="wishlist_product_price_old_{{$p->id_product}}">{{number_format($p->priceOld_product)}}₫</p>
                                <span class="sale-product" id="wishlist_product_sale_{{$p->id_product}}">-{{$p->sale_product}}₫</span>
                            </div>
                        <?php }
                        ?>
                        <strong class="price">{{number_format($p->price_product)}}₫</strong>
                        <!-- <form method="post" action="{{URL::to('/add-cart-ajax')}}"> -->
                    </div>
                </div>
            </a>
            <form class="text-center" style="margin-top: 10px;">
                {{csrf_field()}}
                <input type="hidden" value="1" name="qty" class="cart-product-qty-{{$p->id_product}}">
                <input type="hidden" value="{{$p->id_product}}" name="id_pd" class="cart-product-id-{{$p->id_product}}">
                <input type="hidden" value="{{$p->price_product}}" name="price" class="cart-product-price-{{$p->id_product}}">
                <input type="hidden" value="{{$p->stock2_product}}" name="stock" class="cart-product-stock-{{$p->id_product}}">

                <input type="hidden" value="{{$p->name_product}}" name="name" class="wishlist-product-name-{{$p->id_product}}">
                <?php
                if ($content) {
                    foreach ($content as $ct) {
                        if ($ct->id == $p->id_product) { ?>
                            <input type="hidden" name="qty_cart" value="{{$ct->qty}}" class="cart-product-qty-cart-{{$p->id_product}}">
                        <?php
                            break;
                        } else { ?>
                            <input type="hidden" name="qty_cart" value="" class="cart-product-qty-cart-{{$p->id_product}}">
                <?php }
                    }
                } ?>
                <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id="{{$p->id_product}}">
                    <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                </button>
            </form>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <style type="text/css">
                        ul.nav.nav-pills.nav-justified li {
                            text-align: center;
                            font-size: 13px;
                        }

                        .button-wishlist {
                            border: none;
                            background-color: #fff;
                            color: #b3afa8;
                        }

                        ul.nav.nav-pills.nav-justified i {
                            color: #b3afa8;
                        }

                        .button-wishlist:hover {
                            color: #fe980f;
                        }

                        .button-wishlist:focus {
                            border: none;
                            outline: none;
                        }
                    </style>
                    <li>
                        <i class="fa fa-plus-square"></i>
                        <button class="button-wishlist" id="{{$p->id_product}}_wishlist" onclick="addWishlist(this.id);">Yêu thích</button>
                    </li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div><!--features_items-->

<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <!-- <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li> -->
            <?php $i = 0; ?>
            @foreach($type as $b)
            @if($b->parent_brand != 0)
            <?php $i++; ?>
            <li class="tab-product {{$i == 1 ? 'active' : ''}}" data-id="{{$b->id_brand}}" data-slug="{{$b->slug_brand}}_nav_tab">
                <a href="#{{$b->slug_brand}}_nav_tab" data-toggle="tab">{{$b->name_brand}}</a></li>
            @endif
            @endforeach
        </ul>
    </div>
    <div id="tabs_product"></div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Đề xuất</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($recommend as $re)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <a href="{{ URL::to('/product/'.$re->slug_product)}}" class="link_product" id="wishlist_product_url_{{$re->id_product}}">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{URL::to('public/upload/product/'.$re->img_product)}}" alt="{{$re->img_product}}" 
                                    id="wishlist_product_img_{{$re->id_product}}" />
                                    <p class="name-product">{{$re->name_product}}</p>
                                    <?php
                                    if ($p->sale_product > 0) { ?>
                                        <div class="box-p">
                                            <p class="price-old" id="wishlist_product_price_old_{{$re->id_product}}">{{number_format($re->priceOld_product)}}₫</p>
                                            <span class="sale-product" id="wishlist_product_sale_{{$re->id_product}}">-{{$re->sale_product}}₫</span>
                                        </div>
                                    <?php }
                                    ?>
                                    <strong class="price">{{number_format($re->price_product)}}₫</strong>
                                    <!-- <form method="post" action="{{URL::to('/add-cart-ajax')}}"> -->
                                </div>
                            </div>
                        </a>
                        <form class="text-center" style="margin-top: 10px;">
                            {{csrf_field()}}
                            <input type="hidden" value="1" name="qty" class="cart-product-qty-{{$re->id_product}}">
                            <input type="hidden" value="{{$re->id_product}}" name="id_pd" class="cart-product-id-{{$re->id_product}}">
                            <input type="hidden" value="{{$re->price_product}}" name="price" class="cart-product-price-{{$re->id_product}}">
                            <input type="hidden" value="{{$re->stock2_product}}" name="stock" class="cart-product-stock-{{$re->id_product}}">
                            <input type="hidden" value="{{$re->name_product}}" name="name" class="wishlist-product-name-{{$re->id_product}}">
                            <?php
                            if ($content) {
                                foreach ($content as $ct) {
                                    if ($ct->id == $re->id_product) { ?>
                                        <input type="hidden" name="qty_cart" value="{{$ct->qty}}" class="cart-product-qty-cart-{{$re->id_product}}">
                                    <?php
                                        break;
                                    } else { ?>
                                        <input type="hidden" name="qty_cart" value="" class="cart-product-qty-cart-{{$re->id_product}}">
                            <?php }
                                }
                            } ?>
                            <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id="{{$re->id_product}}">
                                <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                            </button>
                        </form>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li>
                                    <i class="fa fa-plus-square"></i>
                                    <button class="button-wishlist" id="{{$re->id_product}}_wishlist" onclick="addWishlist(this.id);">Yêu thích</button>
                                </li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                            </ul>
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