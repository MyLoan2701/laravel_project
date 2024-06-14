@extends('welcome')
@section('layout')

<div class="heading-divide">
    <div style="font-size: 18px;">Trải nghiệm mua hàng tại <img src="{{URL::to('public/frontend/images/logo.png')}}" alt="" /></div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @yield('content')
            </div>
        </div>
    </div>
</section>

@endsection