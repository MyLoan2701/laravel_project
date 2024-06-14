<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Seo -->
	<meta name="description" content="{{$meta_desc}}">
	<meta name="author" content="">
	<meta name="keywords" content="{{$meta_keywords}}">
	<meta name="robots" content="INDEX,FOLLOW">
	<title>{{$meta_title}}</title>
	<link rel="canonical" href="{{$url_canonical}}">
	<link rel="icon" type="image/x-icon" href="">
	<!-- seo -->
	<link href="{{ asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- <link href="{{ asset('public/frontend/css/all.min.css')}}" rel="stylesheet"> -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
	<!-- jquery UI CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/themes/base/jquery-ui.min.css" integrity="sha512-8PjjnSP8Bw/WNPxF6wkklW6qlQJdWJc/3w/ZQPvZ/1bjVDkrrSqLe9mfPYrMxtnzsXFPc434+u4FHLnLjXTSsg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- //jquery UI CSS -->

	<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="{{('public/frontend/images/favicon.ico')}}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{('public/frontend/images/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{('public/frontend/images/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{('public/frontend/images/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{('public/frontend/images/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/')}}"><img src="{{URL::to('public/frontend/images/logo.png')}}" alt="" /></a>
						</div>
						<!-- <div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div> -->
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php

								use Illuminate\Support\Facades\Session;

								$name = Session::get('name');
								$id_client = Session::get('id_client');
								$id_order = Session::get('id_order');

								if (isset($id_client)) {
								?>
									<li class="dropdown"><a href="{{ URL::to('/client-info') }}"><i class="fa-solid fa-user"></i><?php
																																	if ($name) {
																																		echo $name;
																																		echo ' ' . $id_order . '</a>'; ?>
												<ul role="menu" class="sub-menu">
													<li><a href="{{ URL::to('/client-info') }}">Thông tin tài khoản</a></li>
													<li><a href="{{ URL::to('/client-order') }}">Đơn hàng đã mua</a></li>
													<li><a onclick="return confirm('Bạn muốn Đăng Xuất khỏi tài khoản? Hành động này sẽ không được hoàn tác.')" href="{{URL::to('/logout')}}"><i class="fa fa-user"></i>Đăng xuất</a></li>
												</ul>
									</li>
								<?php }
																																} else {
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
							<?php
																																}
							?>
							<li><a href="{{URL::to('/yeu-thich')}}"><i class="fas fa-heart"></i> Yêu thích</a></li>
							<li><a href="{{URL::to('/cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ URL::to('/home') }}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Cửa Hàng<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										@foreach($type as $brand)
										@if($brand->parent_brand == 0)
										<li><a href="{{ URL::to('/brand/'.$brand->slug_brand) }}">{{$brand->name_brand}}</a></li>
										@endif
										@endforeach
									</ul>
								</li>
								<li><a href="{{URL::to('/post')}}">Tin tức</a></li>
								<li><a href="{{URL::to('/contact-us')}}">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="search_box pull-right">
							<form action="{{URL::to('/tim-kiem')}}" method="get">
								{{csrf_field()}}
								<input type="text" placeholder="Tìm kiếm..." id="search_keywords" name="keywords" />
								<button type="submit" class="btn btn-search">Tìm</button>
							</form>
							<div id="search_ajax" class="search-suggest" style="position: relative;"></div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	@yield('layout')

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{('public/frontend/images/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->



	<script src="{{ asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{ asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{ asset('public/frontend/js/price-range.js')}}"></script>
	<script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
	<script src="{{ asset('public/frontend/js/main.js')}}"></script>
	<script src="{{ asset('public/frontend/js/sweetalert.js')}}"></script> <!--Sweet Alert-->
	<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> Sweet Alert -->
	<script src="{{ asset('public/frontend/js/lightslider.js')}}"></script>
	<script src="{{ asset('public/frontend/js/prettify.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.19/js/lightgallery-all.min.js"></script> <!--lightSlider-->
	<!-- jquery UI -->
	<script src="{{ asset('public/frontend/js/jquery-ui.min.js')}}"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js" integrity="sha512-Ww1y9OuQ2kehgVWSD/3nhgfrb424O3802QYP/A5gPXoM4+rRjiKrjHdGxQKrMGQykmsJ/86oGdHszfcVgUr4hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<!-- //jquery UI -->

	<script type="text/javascript">
		//add + update cart
		$(document).ready(function() {
			$('.add-to-cart').click(function() {
				var id = $(this).data('id');
				var cart_product_id = $('.cart-product-id-' + id).val();
				var cart_product_price = $('.cart-product-price-' + id).val();
				var cart_product_qty = +$('.cart-product-qty-' + id).val();
				var cart_product_qty_cart = +$('.cart-product-qty-cart-' + id).val();
				var cart_product_stock = +$('.cart-product-stock-' + id).val();
				var _token = $('input[name="_token"]').val();
				if (cart_product_qty_cart != '') {
					var tong = (cart_product_qty + cart_product_qty_cart);
					if (tong > cart_product_stock) {
						swal("Số lượng bán trong kho không đủ. Bạn có thể giảm số lượng hoặc đợi cập nhật của cửa hàng.");
					} else {
						if (cart_product_qty_cart > 5) {
							swal("Giới hạn số lượng mua một sản phẩm mỗi lần là 5.");
						} else {
							$.ajax({
								url: "{{url('/add-cart-ajax')}}",
								method: 'POST',
								data: {
									cart_product_id: cart_product_id,
									cart_product_price: cart_product_price,
									cart_product_qty: cart_product_qty,
									_token: _token
								},
								success: function() {
									// alert(data);
									swal({
											title: "Đã thêm sản phẩm vào Giỏ hàng!",
											text: "Bạn có thể tiếp tục mua hàng hoặc đến trang Giỏ hàng để tiến hành thanh toán.",
											showCancelButton: true,
											cancelButtonText: "Xem tiếp",
											confirmButtonClass: "btn-success",
											confirmButtonText: "Đến giỏ hàng",
											closeOnConfirm: false
										},
										function() {
											window.location.href = "{{url('/cart')}}";
										});
								}
							});
						}
					}
				} else {
					if (cart_product_qty > cart_product_stock) {
						swal("Số lượng bán trong kho không đủ. Bạn có thể giảm số lượng hoặc đợi cập nhật của cửa hàng.");
					} else {
						$.ajax({
							url: "{{url('/add-cart-ajax')}}",
							method: 'POST',
							data: {
								cart_product_id: cart_product_id,
								cart_product_price: cart_product_price,
								cart_product_qty: cart_product_qty,
								_token: _token
							},
							success: function() {
								// alert(data);
								swal({
										title: "Đã thêm sản phẩm vào Giỏ hàng!",
										text: "Bạn có thể tiếp tục mua hàng hoặc đến trang Giỏ hàng để tiến hành thanh toán.",
										showCancelButton: true,
										cancelButtonText: "Xem tiếp",
										confirmButtonClass: "btn-success",
										confirmButtonText: "Đến giỏ hàng",
										closeOnConfirm: false
									},
									function() {
										window.location.href = "{{url('/cart')}}";
									});
							}
						});
					}
				}
			});

			$('.update-item-cart').click(function() {
				var id = $(this).data('id');
				var rowId = $('.cart-item-rowId-' + id).val();
				var item_qty = +$('.cart-item-qty-' + id).val();
				var item_stock = +$('.cart-item-stock-' + id).val();
				var _token = $('input[name="_token"]').val();

				if (item_qty > item_stock) {
					swal("Số lượng bán trong kho không đủ. Bạn có thể giảm số lượng hoặc đợi cập nhật của cửa hàng.");
				} else {
					if (item_qty > 5) {
						swal("Giới hạn số lượng mua một sản phẩm mỗi lần là 5.");
					} else {
						$.ajax({
							url: "{{url('/update-item-cart')}}",
							method: 'POST',
							data: {
								item_qty: item_qty,
								item_stock: item_stock,
								rowId: rowId,
								_token: _token
							},
							success: function() {
								window.location.href = "{{url('/cart')}}";
							}
						});
					}
				}
			});
		});
	</script>
	<script type="text/javascript">
		// choose address + add address order
		$(document).ready(function() {
			$('.choose').change(function() {
				var action = $(this).attr('id');
				var ma_id = $(this).val();
				var _token = $('input[name="_token"]').val();
				var result = '';
				// alert(action);alert(matp);alert(_token);
				if (action == "city") {
					result = "province";
				} else {
					result = "wards";
				}
				$.ajax({
					url: "{{url('/admin/select-delivery')}}",
					method: "POST",
					data: {
						action: action,
						ma_id: ma_id,
						_token: _token
					},
					success: function(data) {
						// alert(data);
						$('#' + result).html(data);
					}
				});
			})

			$('.add-address-order').click(function() {
				var city = $('.choose-city').val();
				var province = $('.choose-province').val();
				var wards = $('.choose-wards').val();
				var address = $('.address-order2').val();
				var _token = $('input[name="_token"]').val();
				// alert(address);
				if (city == '' || province == '' || wards == '' || address == '') {
					alert('Vui lòng nhập và chọn đủ để hoàn thành địa chỉ giao hàng.');
				} else {
					$.ajax({
						url: "{{url('/add-address-order')}}",
						method: "POST",
						data: {
							city: city,
							province: province,
							wards: wards,
							address: address,
							_token: _token
						},
						success: function(data) {
							window.location.href = "{{url('/checkout')}}";
						}
					});
				}
			});
		});
	</script>
	<script type="text/javascript">
		//checkout
		$(document).ready(function() {
			$('.check_out').click(function() {
				swal({
						title: "Xác nhận đơn hàng!",
						text: "Bạn xác nhận đặt đơn hàng này?",
						showCancelButton: true,
						cancelButtonText: "Không, khi khác.",
						confirmButtonClass: "btn-success",
						confirmButtonText: "Xác nhận đặt hàng.",
						closeOnConfirm: false,
						colseOnCancel: false,
					},
					function(isConfirm) {
						if (isConfirm) {
							var email = $('.email-order').val();
							var name = $('.name-order').val();
							var phone = $('.phone-order').val();
							var address = $('.address-order3').val();
							var note = $('.note-order').val();
							var code = $('.code-coupon-order').val();
							var price_coupon = $('.price-coupon-order').val();
							var fee_delivery = $('.fee-delivery-order').val();
							var total = $('.total-order').val();
							var total3 = $('.total-order3').val();
							var payment = $('.payment-order').val();
							var _token = $('input[name="_token"]').val();
							if (email == '' && name == '' && phone == '' && address == '' && payment == '') {
								alert('Vui lòng điền đầy đủ thông tin để hoàn tất đặt hàng.')
							} else {
								$.ajax({
									url: "{{url('/save-order')}}",
									method: 'POST',
									data: {
										email: email,
										name: name,
										phone: phone,
										address: address,
										note: note,
										code: code,
										price_coupon: price_coupon,
										fee_delivery: fee_delivery,
										total: total,
										total3: total3,
										payment: payment,
										_token: _token
									},
									success: function() {
										window.location.href = "{{url('/notify')}}";
									}
								});
							}
						}
					});
			});
		});
	</script>
	<script type="text/javascript">
		//lightSlider
		$(document).ready(function() {
			$('#imageGallery').lightSlider({
				gallery: true,
				item: 1,
				loop: true,
				thumbItem: 9,
				slideMargin: 0,
				enableDrag: false,
				currentPagerPosition: 'left',
				onSliderLoad: function(el) {
					el.lightGallery({
						selector: '#imageGallery .lslide'
					});
				}
			});
		});
	</script>
	<script type="text/javascript">
		//search suggest
		$(document).ready(function() {
			$('#search_keywords').keyup(function() {
				var query = $(this).val();
				if (query != '') {
					var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "{{url('/autocomplete-ajax')}}",
						method: 'POST',
						data: {
							query: query,
							_token: _token
						},
						success: function(data) {
							$('#search_ajax').fadeIn();
							$('#search_ajax').html(data);
						}
					});
				} else {
					$('#search_ajax').fadeOut();
				}
			});
		});
	</script>
	<script type="text/javascript">
		// comment product
		$(document).ready(function() {
			$('.submit-comment').click(function() {
				var id_product = $('.id-product-comment').val();
				var id_client = $('.id-client-comment').val();
				var name = $('.name-comment').val();
				var email = $('.email-comment').val();
				var content = $('.content-comment-2').val();
				var _token = $('input[name="_token"]').val();

				if (id_product == '' || name == '' || email == '' || content == '') {
					swal("Vui lòng nhập đủ các thông tin cần thiết.");
				} else {
					$.ajax({
						url: "{{url('/waiting-comment-approval-ajax')}}",
						method: 'POST',
						data: {
							id_product: id_product,
							id_client: id_client,
							name: name,
							email: email,
							content: content,
							_token: _token
						},
						success: function() {
							// alert(data);
							swal("Bình luận của bạn đã được gửi thành công. Quản trị viên sẽ phê duyệt bình luận sớm nhất có thể.");
						}
					});
				}
			});
		});
	</script>
	<script type="text/javascript">
		// tab product
		$(document).ready(function() {
			var id = $('.tab-product').data('id');
			var slug = $('.tab-product').data('slug');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{url('/tab-product-ajax')}}",
				method: 'POST',
				data: {
					id: id,
					slug: slug,
					_token: _token
				},
				success: function(data) {
					$('#tabs_product').html(data);
				}
			});

			$('.tab-product').click(function() {
				var id = $(this).data('id');
				var slug = $(this).data('slug');
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{url('/tab-product-ajax')}}",
					method: 'POST',
					data: {
						id: id,
						slug: slug,
						_token: _token
					},
					success: function(data) {
						$('#tabs_product').html(data);
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		//account client
		$(document).ready(function() {
			$('.edit-account-client').click(function() {
				var sex = $('input[name="sex"]:checked').val();
				// var name = $('.name-client').val();
				var name = $('input[name="name_client"]').val();
				var phone = $('.phone-client').val();
				// var p_old = $('.password-old').val();
				var p_new = $('.password-new').val();
				var p_re = $('.password-re-enter').val();

				var _token = $('input[name="_token"]').val();

				if (name == '' || phone == '') {
					var warn = '<div class="alert-t alert-warning alert-icon">Vui lòng nhập đầy đủ Số điện thoại và họ tên.</div>';
					$('#warn-empty-input-account').html(warn);
				} else {
					if (p_new != '' && p_re != '') {
						if (p_new.length < 6) {
							var warn2 = '<div class="alert-t alert-warning alert-icon">Mật khẩu mới phải có ít nhất 6 ký tự.</div>';
							$('#warn-empty-input-account2').html(warn2);
						} else {
							if (p_new == p_re) {
								$.ajax({
									url: "{{url('/update-account')}}",
									method: "POST",
									data: {
										sex: sex,
										name: name,
										phone: phone,
										p_new: p_new,
										_token: _token
									},
									success: function(data) {
										$('#notify-account').html(data);
									}
								});
							} else {
								var warn2 = '<div class="alert-t alert-warning alert-icon">Nhập lại mật khẩu mới không đúng.</div>';
								$('#warn-empty-input-account2').html(warn2);
							}
						}
					} else if (p_new == '' && p_re == '') {
						$.ajax({
							url: "{{url('/update-account')}}",
							method: "POST",
							data: {
								sex: sex,
								name: name,
								phone: phone,
								_token: _token
							},
							success: function(data) {
								$('#notify-account').html(data);
							}
						});
					} else {
						var warn2 = '<div class="alert-t alert-warning alert-icon">Nếu bạn muốn thay đổi Mật khẩu, vui lòng nhập đầy đủ các trường bên dưới.</div>';
						$('#warn-empty-input-account2').html(warn2);
					}
				}
			});

			$('.add-address-order-account').click(function() {
				var city = $('.choose-city').val();
				var province = $('.choose-province').val();
				var wards = $('.choose-wards').val();
				var address = $('.address-order2').val();
				var _token = $('input[name="_token"]').val();
				// alert(address);
				if (city == '' && province == '' && wards == '' && address == '') {
					alert('Vui lòng nhập và chọn đủ để hoàn thành địa chỉ giao hàng.');
				} else {
					$.ajax({
						url: "{{url('/add-address-order-account')}}",
						method: "POST",
						data: {
							city: city,
							province: province,
							wards: wards,
							address: address,
							_token: _token
						},
						success: function(data) {
							$('#notify-account2').html(data);
						}
					});
				}
			});
		});
	</script>
	<script type="text/javascript">
		// filter sort
		$(document).ready(function() {
			var min, max;
			$('.money-sort').click(function() {
				$('.list-filter-child[data-index="0"]').addClass('active');
				min = $(this).data('min');
				max = $(this).data('max');

				$("#slider_range_money_sort").slider({
					orientation: "horizontal",
					range: true,
					min: min,
					max: max,
					values: [min, max],
					step: 100,
					slide: function(event, ui) {
						// $("#amount_money_sort").val(ui.values[0].toLocaleString('en') + ",000đ - " + ui.values[1].toLocaleString('en') + ",000đ");
						$("#price_start_money_sort").val(ui.values[0].toLocaleString('en') + ",000đ");
						$("#price_end_money_sort").val(ui.values[1].toLocaleString('en') + ",000đ");
					}
				});
				// $("#amount_money_sort").val($("#slider_range_money_sort").slider("values", 0).toLocaleString('en') +
				// 	",000đ - " + $("#slider_range_money_sort").slider("values", 1).toLocaleString('en') + ",000đ");
				$("#price_start_money_sort").val(min.toLocaleString('en') + ",000đ");
				$("#price_end_money_sort").val($("#slider_range_money_sort").slider("values", 1).toLocaleString('en') + ",000đ");
			});

			$('.type-sort').click(function() {
				$('.list-filter-child[data-index="1"]').addClass('active');
				// $(window).click(function(event) {
				// 	if (!$(event.target).is('.list-filter-child[data-index="1"]')) {
				// 		$('.list-filter-child[data-index="1"]').removeClass('active');
				// 	}
				// });
			});

			$('.btn-filter-close').click(function() {
				$('.list-filter-child[data-index="0"]').removeClass('active');
				$('.list-filter-child[data-index="1"]').removeClass('active');
			});

			$('.available-sort').click(function() {
				var href = $(this).data('href');
				var currentLink = window.location.href;
				var separator = currentLink.includes('?') ? '&' : '?';
				if (currentLink.includes('available')) {} 
				else {window.location = currentLink + separator + 'available=' + href;}
			});

			$('.btn-unchecked').click(function() {
				var sort = $(this).data('sort');
				var currentLink = window.location.href;
				var urlParts = currentLink.split('?');
				var baseUrl = urlParts[0];
				switch (sort) {
					case 'all':
						window.location = baseUrl;
						break;
					case 'available':
						var queryParams = urlParts[1].split('&');
						for (let i = 0; i < queryParams.length; i++) {
							if (queryParams[i].includes('available')) {
								queryParams.splice(i, 1);
								break
							}
						}
						queryParams = queryParams.join('&');
						window.location = baseUrl + '?' + queryParams;
						break;
					case 'type':
						var queryParams = urlParts[1].split('&');
						for (let i = 0; i < queryParams.length; i++) {
							if (queryParams[i].includes('type')) {
								queryParams.splice(i, 1);
								break
							}
						}
						queryParams = queryParams.join('&');
						window.location = baseUrl + '?' + queryParams;
						break;
					case 'money-sort':
						var queryParams = urlParts[1].split('&');
						for (let i = 0; i < queryParams.length; i++) {
							if (queryParams[i].includes('money_sort')) {
								queryParams.splice(i, 1);
								break
							}
						}
						queryParams = queryParams.join('&');
						window.location = baseUrl + '?' + queryParams;
						break;
					case 'sort-by':
						var queryParams = urlParts[1].split('&');
						for (let i = 0; i < queryParams.length; i++) {
							if (queryParams[i].includes('sort-by')) {
								queryParams.splice(i, 1);
								break
							}
						}
						queryParams = queryParams.join('&');
						window.location = baseUrl + '?' + queryParams;
						break;
					case 'sort-money':
						var queryParams = urlParts[1].split('&');
						for (let i = 0; i < queryParams.length; i++) {
							if (queryParams[i].includes('price_start') || queryParams[i].includes('price_end') ||
								queryParams[i].includes('sort_money')) {
								queryParams.splice(i, 1);
								i--;
							}
						}
						queryParams = queryParams.join('&');
						window.location = baseUrl + '?' + queryParams;
						break;
				}
			});

			function setUrlSortForm() {
				var currentUrl = window.location.href;
				var ipt = document.getElementById("link_get_sort");

				// Parse the current URL to extract existing GET parameters
				var urlParams = new URLSearchParams(window.location.search);
				var existingParams = urlParams.toString();
				if (isEmptyString(existingParams) == false) {
					var urlParts = existingParams.split('&');
					for (var i = 0; i < urlParts.length; i++) {
						var pair = urlParts[i].split('=');
						if (pair[0] == 'available') {
							var hiddenInput = document.createElement("input");
							hiddenInput.type = "hidden";
							hiddenInput.name = "available";
							hiddenInput.value = pair[1];

							// Get the form element by its ID
							var form = document.getElementById("form_money_sort");

							// Append the hidden input to the form
							form.appendChild(hiddenInput);
						}
						if (pair[0] == 'type') {
							var hiddenInput = document.createElement("input");
							hiddenInput.type = "hidden";
							hiddenInput.name = "type";
							hiddenInput.value = pair[1];
							var form = document.getElementById("form_money_sort");
							form.appendChild(hiddenInput);
						}
						if (pair[0] == 'sort_by') {
							var hiddenInput = document.createElement("input");
							hiddenInput.type = "hidden";
							hiddenInput.name = "sort_by";
							hiddenInput.value = pair[1];
							var form = document.getElementById("form_money_sort");
							form.appendChild(hiddenInput);
						}
					}
				}
			}
			setUrlSortForm();
		});
	</script>


	<script>
		function isEmptyString(str) {
			return str.trim().length === 0;
		}
		//add to cart
		function addToCart(click_id) {
			var id = click_id.replace('_add_to_cart', '');
			var cart_product_id = $('.cart-product-id-' + id).val();
			var cart_product_price = $('.cart-product-price-' + id).val();
			var cart_product_qty = +$('.cart-product-qty-' + id).val();
			var cart_product_qty_cart = +$('.cart-product-qty-cart-' + id).val();
			var cart_product_stock = +$('.cart-product-stock-' + id).val();
			var _token = $('input[name="_token"]').val();
			if (cart_product_qty_cart != '') {
				var tong = (cart_product_qty + cart_product_qty_cart);
				if (tong > cart_product_stock) {
					swal("Số lượng bán trong kho không đủ. Bạn có thể giảm số lượng hoặc đợi cập nhật của cửa hàng.");
				} else {
					if (cart_product_qty_cart > 5) {
						swal("Giới hạn số lượng mua một sản phẩm mỗi lần là 5.");
					} else {
						$.ajax({
							url: "{{url('/add-cart-ajax')}}",
							method: 'POST',
							data: {
								cart_product_id: cart_product_id,
								cart_product_price: cart_product_price,
								cart_product_qty: cart_product_qty,
								_token: _token
							},
							success: function() {
								// alert(data);
								swal({
										title: "Đã thêm sản phẩm vào Giỏ hàng!",
										text: "Bạn có thể tiếp tục mua hàng hoặc đến trang Giỏ hàng để tiến hành thanh toán.",
										showCancelButton: true,
										cancelButtonText: "Xem tiếp",
										confirmButtonClass: "btn-success",
										confirmButtonText: "Đến giỏ hàng",
										closeOnConfirm: false
									},
									function() {
										window.location.href = "{{url('/cart')}}";
									});
							}
						});
					}
				}
			} else {
				if (cart_product_qty > cart_product_stock) {
					swal("Số lượng bán trong kho không đủ. Bạn có thể giảm số lượng hoặc đợi cập nhật của cửa hàng.");
				} else {
					$.ajax({
						url: "{{url('/add-cart-ajax')}}",
						method: 'POST',
						data: {
							cart_product_id: cart_product_id,
							cart_product_price: cart_product_price,
							cart_product_qty: cart_product_qty,
							_token: _token
						},
						success: function() {
							// alert(data);
							swal({
									title: "Đã thêm sản phẩm vào Giỏ hàng!",
									text: "Bạn có thể tiếp tục mua hàng hoặc đến trang Giỏ hàng để tiến hành thanh toán.",
									showCancelButton: true,
									cancelButtonText: "Xem tiếp",
									confirmButtonClass: "btn-success",
									confirmButtonText: "Đến giỏ hàng",
									closeOnConfirm: false
								},
								function() {
									window.location.href = "{{url('/cart')}}";
								});
						}
					});
				}
			}
		}
		//add to cart//

		//filter sort
		function urlSort(key, val) {
			var currentLink = window.location.href;
			var separator = currentLink.includes('?') ? '&' : '?';

			var urlParts = currentLink.split('?');
			if (urlParts.length >= 2) {
				var baseUrl = urlParts[0];
				var queryString = urlParts[1];

				// Split query string into array of parameters
				var queryParams = queryString.split('&');

				var count = 0;

				// Iterate through parameters to find and update 'sort_by' parameter
				for (var i = 0; i < queryParams.length; i++) {
					var pair = queryParams[i].split('=');
					if (pair[0] == key) {
						count++;
						pair[1] = val;
						queryParams[i] = pair.join('=');
						break; // Exit loop once 'sort_by' parameter is found and updated
					}
				}

				//Check to see if the key exists or not. If it does not exist, it will be added. If it exists, the value will be replaced.
				if (count == 0) {
					var updatedUrl = baseUrl + '?' + queryParams.join('&') + separator + key + '=' + val;
				} else {
					// Reconstruct the URL
					var updatedUrl = baseUrl + '?' + queryParams.join('&');
				}
				window.location = updatedUrl;
			} else {
				// No query parameters, just append 'sort_by' parameter
				window.location = currentLink + '?' + key + '=' + val;
			}
			//window.location = currentLink + separator + href;
		}

		function moneySort(key, val) {
			var currentLink = window.location.href;
			var separator = currentLink.includes('?') ? '&' : '?';
			var urlParams = new URLSearchParams(window.location.search);
			var existingParams = urlParams.toString();
			var urlParts = existingParams.split('&');
			for (var i = 0; i < urlParts.length; i++) {
				if (urlParts[i].includes('price_start') || urlParts[i].includes('price_end') ||
					urlParts[i].includes('sort_money') || urlParts[i].includes('money_sort')) {
					urlParts.splice(i, 1);
					i--; // Decrement the loop counter to adjust for removed element
				}
			}
			urlParts = urlParts.join('&');
			var urlParts2 = currentLink.split('?');
			var baseUrl = urlParts2[0];
			if (isEmptyString(urlParts)) {
				window.location = baseUrl + '?' + key + '=' + val;
			} else {
				window.location = baseUrl + '?' + urlParts + '&' + key + '=' + val;
			}
		}

		function filteringBy() {
			var currentLink = window.location.href;
			var urlParams = new URLSearchParams(window.location.search);
			var existingParams = urlParams.toString();
			if (existingParams.includes('type') || existingParams.includes('available') ||
				existingParams.includes('money_sort') || existingParams.includes('sort_by') ||
				(existingParams.includes('price_start') && existingParams.includes('price_end') &&
					existingParams.includes('sort_money'))) {
				$('#filtering_by').css('display', 'block');
				var urlParts = existingParams.split('&');
				var sort_money = '';
				var price_start, price_end;
				for (var i = 0; i < urlParts.length; i++) {
					if (urlParts[i].includes('price_start') || urlParts[i].includes('price_end') || urlParts[i].includes('sort_money')) {
						sort_money = sort_money + '&' + urlParts[i];
						if (sort_money.includes('price_start') && sort_money.includes('price_end') && sort_money.includes('sort_money')) {
							sort_money = sort_money.substring(1);
							var queryparams = sort_money.split('&');
							for (let j = 0; j < queryparams.length; j++) {
								var pair = queryparams[j].split('=');
								if (pair[0] == 'price_start') {
									price_start = decodeURIComponent(pair[1]);
								}
								if (pair[0] == 'price_end') {
									price_end = decodeURIComponent(pair[1]);
								}
							}
							// Replace encoded characters with appropriate ones
							price_start = price_start.replace('%2C', ',').replace('%C4%91', 'đ');
							price_end = price_end.replace('%2C', ',').replace('%C4%91', 'đ');

							var btn = document.createElement("button");
							btn.classList.add('btn-filter', 'active', 'btn-unchecked');

							// Set button value
							var buttonText = document.createTextNode('x ' + price_start + ' - ' + price_end);
							btn.appendChild(buttonText);

							// Add data-sort attribute
							btn.setAttribute('data-sort', 'sort-money');

							// Append button to div
							var div = document.getElementById("filter_module__filtering_by");
							div.appendChild(btn);
						}
					}
					if (urlParts[i].includes('type')) {
						var pair = urlParts[i].split('=');
						var btn = document.createElement("button");
						btn.classList.add('btn-filter', 'active', 'btn-unchecked');
						var buttonText = document.createTextNode('x Loại sản phẩm: ' + pair[1]);
						btn.appendChild(buttonText);
						btn.setAttribute('data-sort', 'type');
						var div = document.getElementById("filter_module__filtering_by");
						div.appendChild(btn);
					}
					if (urlParts[i].includes('available')) {
						var pair = urlParts[i].split('=');
						var btn = document.createElement("button");
						btn.classList.add('btn-filter', 'active', 'btn-unchecked');
						var buttonText = document.createTextNode('x Sẵn hàng');
						btn.appendChild(buttonText);
						btn.setAttribute('data-sort', 'available');
						var div = document.getElementById("filter_module__filtering_by");
						div.appendChild(btn);
					}
					if (urlParts[i].includes('money_sort')) {
						var pair = urlParts[i].split('=');
						var btn = document.createElement("button");
						btn.classList.add('btn-filter', 'active', 'btn-unchecked');
						var buttonText = document.createTextNode('x Giá: ' + pair[1]);
						btn.appendChild(buttonText);
						btn.setAttribute('data-sort', 'money-sort');
						var div = document.getElementById("filter_module__filtering_by");
						div.appendChild(btn);
					}
					if (urlParts[i].includes('sort_by')) {
						var pair = urlParts[i].split('=');
						var btn = document.createElement("button");
						btn.classList.add('btn-filter', 'active', 'btn-unchecked');
						switch (pair[1]) {
							case 'new':
								var buttonText = document.createTextNode('x Sắp xếp: Mới nhất');
								break;
							case 'hot':
								var buttonText = document.createTextNode('x Sắp xếp: Nổi bật');
								break;
							case 'sale':
								var buttonText = document.createTextNode('x Sắp xếp: Khuyến mãi');
								break;
							case 'az':
								var buttonText = document.createTextNode('x Sắp xếp: A - Z');
								break;
							case 'za':
								var buttonText = document.createTextNode('x Sắp xếp: Z - A');
								break;
							case 'desc':
								var buttonText = document.createTextNode('x Sắp xếp: Giảm dần');
								break;
							case 'asc':
								var buttonText = document.createTextNode('x Sắp xếp: Tăng dần');
								break;
						}
						btn.appendChild(buttonText);
						btn.setAttribute('data-sort', 'sort-by');
						var div = document.getElementById("filter_module__filtering_by");
						div.appendChild(btn);
					}
				}
			}

		}
		filteringBy()
		//filter sort//

		//change display
		function changeDisplayProfile() {
			document.getElementById('profile-edit').style.display = "none";
			document.getElementById('profile-edit-form').style.display = "block";
		}

		function changeDisplayProfile2() {
			document.getElementById('profile-edit').style.display = "block";
			document.getElementById('profile-edit-form').style.display = "none";
		}

		function changeDisplayProfile3() {
			document.getElementById('address-edit').style.display = "none";
			document.getElementById('address-edit-form').style.display = "block";
		}

		function changeDisplayProfile4() {
			document.getElementById('address-edit').style.display = "block";
			document.getElementById('address-edit-form').style.display = "none";
		}
		//change display//

		//check stock
		function checkStockProduct(val, stock) {
			if (val > stock) {
				$('#warning-stock').html("Số lượng bán trong kho không đủ. Bạn có thể giảm số lượng hoặc đợi cập nhật của cửa hàng.");
				document.getElementById("add-cart-block").setAttribute("disabled", true);
			} else {
				if (val > 5) {
					$('#warning-stock').html("Giới hạn số lượng mua một sản phẩm mỗi lần là 5.");
					document.getElementById("add-cart-block").setAttribute("disabled", true);
				} else {
					$('#warning-stock').html('');
					document.getElementById("add-cart-block").disabled = false;
				}
			}
		}
		//check stock//

		//wishlist
		function view() {
			if (localStorage.getItem('data') != null) {
				var data = JSON.parse(localStorage.getItem('data'));
				data.reverse();
				document.getElementById('row_wishlist').style.overflow = 'scroll';
				document.getElementById('row_wishlist').style.height = '600px';

				for (let i = 0; i < data.length; i++) {
					var name = data[i].name;
					var price = data[i].price;
					var img = data[i].img;
					var url = data[i].url;
					$('#row_wishlist').append('<div class="row" style="margin:10px 0; border-bottom: 1px solid #eee;"><div class="col-md-4"><img src="' +
						img + '" width="100%"></div><div class="col-md-8 info-wishlist"><p style="font-weight: 600;">' +
						name + '</p><p style="color: #fe980f;">' +
						price + '</p><a href="' + url + '">Chi tiết</a></div></div>');
				}
			}
		}
		view();

		function viewWishlist() {
			if (localStorage.getItem('data') != null) {
				var data = JSON.parse(localStorage.getItem('data'));
				data.reverse();

				if (data.length == 0) {
					$('#item_wishlist').append('<div class="col-sm-12 text-center" style="font-style:italic">(Không có sản phẩm nào)</div>');
				}
				for (let i = 0; i < data.length; i++) {
					var name = data[i].name;
					var price = data[i].price;
					var img = data[i].img;
					var url = data[i].url;
					var priceOld = data[i].priceOld;
					var sale = data[i].sale;
					var id = data[i].id;
					if (sale != '') {
						var str = '<div class="box-p"><p class="price-old">' +
							priceOld + '</p><span class="sale-product">' + sale + '</span></div>'
					} else var str = '';
					$('#item_wishlist').append('<div class="col-sm-4"><div class="product-image-wrapper" style="height:400px"><a href="' +
						url + '" class="link_product" id="wishlist_product_url_' +
						id + '"><div class="single-products"><div class="productinfo text-center"><img src="' +
						img + '" alt="' + name + '" id="wishlist_product_img_' + id + '"/><p class="name-product">' +
						name + '</p>' + str + '<strong class="price">' +
						price + '</strong></div></div></a><div class="choose"><ul class="nav nav-pills nav-justified"><li><i class="fa fa-plus-square"></i><button class="button-wishlist" id="' +
						id + '_del_wishlist" onclick="delWishlist(this.id);"> Bỏ Yêu thích</button></li><li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li></ul></div></div></div>'
					);
				}
			}
		}
		viewWishlist();

		function addWishlist(clicked_id) {
			var id = clicked_id.replace('_wishlist', '');
			var name = $('.wishlist-product-name-' + id).val();
			var price = $('.cart-product-price-' + id).val();
			price = parseInt(price).toLocaleString("vi-VN", {
				style: "currency",
				currency: "VND"
			});
			var img = document.getElementById('wishlist_product_img_' + id).src;
			var url = document.getElementById('wishlist_product_url_' + id).href;
			var priceOld = document.getElementById('wishlist_product_price_old_' + id).innerHTML;
			var sale = document.getElementById('wishlist_product_sale_' + id).innerHTML;

			var newItem = {
				'name': name,
				'id': id,
				'url': url,
				'price': price,
				'img': img,
				'priceOld': priceOld,
				'sale': sale
			}
			if (localStorage.getItem('data') == null) {
				localStorage.setItem('data', '[]');
			}
			var old_data = JSON.parse(localStorage.getItem('data'));
			var matches = $.grep(old_data, function(obj) {
				return obj.id == id;
			});
			if (matches.length) {
				alert("Sản phẩm đã được thêm vào YÊU THÍCH, không thể thêm.");
			} else {
				old_data.push(newItem);
				$('#row_wishlist').append('<div class="row" style="margin:10px 0; border-bottom: 1px solid #eee;"><div class="col-md-4"><img src="' +
					newItem.img + '" width="100%"></div><div class="col-md-8 info-wishlist"><p style="font-weight: 600;">' +
					newItem.name + '</p><p style="color: #fe980f;">' +
					newItem.price + '</p><a href="' + newItem.url + '">Chi tiết</a></div></div>');
			}
			localStorage.setItem('data', JSON.stringify(old_data));
		}

		function delWishlist(clicked_id) {
			var id = clicked_id.replace('_del_wishlist', '');

			var old_data = JSON.parse(localStorage.getItem('data'));
			var index = old_data.findIndex(function(obj) {
				return obj.id == id;
			});

			if (index !== -1) {
				old_data.splice(index, 1);
				localStorage.setItem('data', JSON.stringify(old_data));
				location.reload()
			}
		}
		//wishlist//
	</script>
</body>

</html>