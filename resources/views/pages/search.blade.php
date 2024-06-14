@extends('layouts.layoutC1')
@section('content')

<?php
use Gloudemans\Shoppingcart\Facades\Cart;
$content = Cart::content();
?>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm "{{$name}}"</h2>
    <?php $count = 0; ?>
    @foreach($product as $key => $p)
    <?php $count ++; ?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <a href="{{ URL::to('/product/'.$p->slug_product)}}" class="link_product">

                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/upload/product/'.$p->img_product)}}" alt="{{$p->img_product}}" />
                        <p class="name-product">{{$p->name_product}}</p>
                        <?php 
                        if ($p->sale_product > 0) {?>
                            <div class="box-p">
                            <p class="price-old">{{number_format($p->priceOld_product)}}₫</p>
                            <span class="sale-product">-{{$p->sale_product}}₫</span>
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
                <input type="hidden" value="{{$p->stock2_product}}"  name="stock" class="cart-product-stock-{{$p->id_product}}">
                <?php 
                if ($content) {
                    foreach($content as $ct) {
                        if ($ct->id == $p->id_product) {?>
                            <input type="hidden" name="qty_cart" value="{{$ct->qty}}" class="cart-product-qty-cart-{{$p->id_product}}">
                        <?php 
                        break;
                        }
                        else {?>
                            <input type="hidden" name="qty_cart" value="" class="cart-product-qty-cart-{{$p->id_product}}">
                        <?php }                 
                    }
                }?>
                <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id="{{$p->id_product}}">
                    <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                </button>
            </form>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    @if($count == 0)
    <p style="text-align: center;
    font-size: larger;
    font-style: italic;">Không có sản phẩm nào được tìm thấy.</p>
    @endif
</div><!--features_items-->
@endsection