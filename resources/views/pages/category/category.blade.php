@extends('layouts.layoutC1')
@section('content')

<?php

use Gloudemans\Shoppingcart\Facades\Cart;

$content = Cart::content();
?>
<div class="filter-sort">
    <div class="filter-sort-title">Chọn theo tiêu chí</div>
    <div class="filter-module-container">
        <div id="filter_module">
            <div class="filter-list">
                <div><button class="filter-wrapper btn-filter available-sort" data-href="co-san"><i class="fa-solid fa-truck"></i> <span>Sẵn hàng</span></button></div>
                <div>
                    <button class="filter-wrapper btn-filter money-sort" data-min="{{$min_price}}" data-max="{{$max_price}}"><!--<i class="fa-solid fa-money-bill"></i>--> <span>Giá</span> <i style="margin-left: 6px;" class="fa-solid fa-caret-down"></i></button>
                    <div class="list-filter-child" data-index="0" style="width: 450px;">
                        <ul>
                            @foreach($sort as $s)
                            <li>
                                <button class="btn-filter-item money-sort-item" data-from="{{$s->from_sort}}" data-to="{{$s->to_sort}}" data-href="{{$s->href_sort}}" data-id-sort="{{$s->id_sort}}" onclick="moneySort('money_sort', this.getAttribute('data-href'))">{{$s->name_sort}}</button>
                            </li>
                            @endforeach
                        </ul>
                        <form method="get" id="form_money_sort">
                            <p style="margin-bottom: 0;">
                                <label for="amount">Tùy chọn mức giá:</label>
                                <!-- <input type="text" id="amount_money_sort" readonly="" style="border:0; color:#f6931f; font-weight:bold;"> -->
                            </p>
                            <div style="height: 50px; display: flex; gap: 10px; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                <input type="text" min="0" id="price_start_money_sort" readonly="" name="price_start" value=",000đ" style="border:1px solid #c2c2c2; color:#f6931f; font-weight:bold;">
                                <span> - </span>
                                <input type="text" min="0" id="price_end_money_sort" readonly="" name="price_end" value=",000đ" style="border:1px solid #c2c2c2; color:#f6931f; font-weight:bold; ">
                            </div>

                            <div id="slider_range_money_sort"></div>
                            <input type="submit" value="Lọc giá" class="btn btn-warn btn-sort-money" name="sort_money" style="margin: 10px auto; width: 80px;">

                        </form>
                        <div class="filter-close" style="text-align: center;">
                            <button class="btn btn-filter-close btn-danger" data-index="0">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="filtering_by">
        <div class="filter-sort-title">Đang lọc theo</div>
        <div class="filter-module-container" id="filter_module__filtering_by">
            <button class="btn-filter btn-unchecked active" data-sort="all"> x Bỏ chọn tất cả</button>
        </div>
    </div>
    <div class="filter-sort-title">Sắp xếp theo</div>
    <div class="filter-module-container">
        <div id="filter_module_sort">
            <div class="filter-list">
                <a class="filter-wrapper btn-filter" onclick="urlSort('sort_by','new')"><span>Gần đây</span></a>
                <a class="filter-wrapper btn-filter" onclick="urlSort('sort_by','hot')"><span>Nổi bật</span></a>
                <a class="filter-wrapper btn-filter" onclick="urlSort('sort_by','desc')"><i class="fa-solid fa-arrow-up-wide-short"></i> <span>Giá cao - thấp</span></a>
                <a class="filter-wrapper btn-filter" onclick="urlSort('sort_by','asc')"><i class="fa-solid fa-arrow-up-short-wide"></i> <span>Giá thấp - cao</span></a>
                <a class="filter-wrapper btn-filter" onclick="urlSort('sort_by','sale')"><i class="fa-solid fa-percent"></i> <span>Khuyến mãi hot</span></a>
                <a class="filter-wrapper btn-filter" onclick="urlSort('sort_by','az')"><i class="fa-solid fa-arrow-up-a-z"></i> <span>Lọc theo tên A - Z</span></a>
                <a class="filter-wrapper btn-filter" onclick="urlSort('sort_by','za')"><i class="fa-solid fa-arrow-up-z-a"></i> <span>Lọc theo tên Z - A</span></a>
            </div>
        </div>
    </div>
</div>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Danh mục sản phẩm thuộc {{$nameC->name_category}}</h2>
    @foreach($product as $key => $p)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <a href="{{ URL::to('/product/'.$p->slug_product)}}" class="link_product" id="wishlist_product_url_{{$p->id_product}}">

                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/upload/product/'.$p->img_product)}}" alt="{{$p->img_product}}" 
                        id="wishlist_product_img_{{$p->id_product}}"/>
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
                    <li>
                        <i class="fa fa-plus-square"></i>
                        <button class="button-wishlist" id="{{$p->id_product}}_wishlist" onclick="addWishlist(this.id);">Yêu thích</button>
                    </li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div> -->
    @endforeach
</div><!--features_items-->
@endsection