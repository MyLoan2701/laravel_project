@extends('layouts.layoutC1')
@section('content')

<?php
use Gloudemans\Shoppingcart\Facades\Cart;
$content = Cart::content();
?>

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm Yêu Thích</h2>
    
    <div id="item_wishlist"></div>
</div><!--features_items-->
@endsection