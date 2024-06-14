@extends('welcome')
@section('layout')

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <?php $i = 0; ?>
                        @foreach($banner as $bn)
                        <?php $i++; ?>
                        <div class="item <?php echo $retVal = ($i == 1) ? 'active' : ''; ?>">
                            <div class="col-sm-12">
                                <img src="{{URL::to('public/upload/banner/'.$bn->img_banner)}}" class="img img-responsive img-banner" alt="{{$bn->description_banner}}" />
                                <!-- <img src="{{('public/frontend/images/pricing.png')}}" class="pricing" alt="" /> -->
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                    <div class="brands_products"><!--brands_products-->
                        <h2>Loại sản phẩm</h2>
                        <div class="brands-name">
                            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                                <!-- <ul class="nav nav-pills nav-stacked"> -->
                                <!-- <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li> -->
                                @foreach($type as $key => $t)
                                @if($t->parent_brand == 0)
                                
                                <?php
                                $count = 0;
                                foreach($type as $p) {
                                    if ($p->parent_brand == $t->id_brand) {
                                        $count ++;
                                    }
                                }?>
                                @if($count > 0)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$t->slug_brand}}">
                                                <span class="badge pull-right">(số lượng) <i class="fa fa-plus"></i></span>
                                                {{$t->name_brand}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{$t->slug_brand}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                <li><a href="{{ URL::to('/brand/'.$t->slug_brand)}}">Tất cả </a></li>
                                                @foreach($type as $pr)
                                                @if($pr->parent_brand == $t->id_brand)
                                                <li><a href="{{ URL::to('/brand-type/'.$pr->slug_brand)}}">{{$pr->name_brand}} </a></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                               @else
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="{{ URL::to('/brand/'.$t->slug_brand)}}">
                                                <span class="badge pull-right">(số lượng) <i class="fa fa-plus" style="display: unset; visibility: hidden;"></i></span>{{$t->name_brand}}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div><!--/category-products-->
                            <!-- </ul> -->
                        </div>
                    </div><!--/brands_products-->

                    <h2>Thương Hiệu</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach($category as $key => $c)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{ URL::to('/category/'.$c->slug_category)}}">{{ $c->name_category }}</a></h4>
                            </div>
                        </div>
                        @endforeach
                    </div><!--/category-products-->

                    <div class="wishlist"><!--wishlist-->
                        <h2>Sản phẩm yêu thích</h2>
                        <div id="row_wishlist">
                        </div>
                    </div><!--/wishlist-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{('public/frontend/images/shipping.jpg')}}" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                @yield('content')
            </div>
        </div>
    </div>
</section>

@endsection