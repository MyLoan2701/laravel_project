@extends('layouts.layoutC2')
@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Đăng nhập tài khoản của bạn</h2>
					<?php

					use Illuminate\Support\Facades\Session;

					$mess = Session::get('message');
					if ($mess) {
						echo '<div class="alert-t alert-success">' . $mess . '</div>';
						Session::put('message', null);
					}
					$warn2 = Session::get('warning2');
					if ($warn2) {
						echo '<span class="text-alert">' . $warn2 . '</span>';
						Session::put('warning2', null);
					}
					?>
					<form action="{{URL::to('/login')}}" method="post">
						{{csrf_field()}}
						<input type="email" placeholder="Nhập địa chỉ Email" name="email_login" required/>
						<input type="password" placeholder="Nhập mật khẩu" name="password_login" required/>
						<span>
							<input type="checkbox" class="checkbox">
							Ghi nhớ đăng nhập
						</span>
						<button type="submit" class="btn btn-default">Đăng nhập</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-12" style="display: flex; justify-content: center;">
				<h2 class="or">Hoặc</h2>
			</div>
			<div class="col-sm-12 col-sm-offset-1">
				<div class="signup-form"><!--sign up form-->
					<h2>Đăng ký tài khoản mới!</h2>
					<?php

					$mess = Session::get('message');
					if ($mess) {
						echo '<span class="alert-t alert-success">' . $mess . '</span>';
						Session::put('message', null);
					}

					$warn = Session::get('warning');
					if ($warn) {
						echo '<span class="text-alert">' . $warn . '</span>';
						Session::put('warning', null);
					}
					?>
					<form action="{{URL::to('/signup')}}" method="post">
						{{csrf_field()}}
						<input type="text" placeholder="Tên tài khoản" name="name_client" required />
						<input type="email" placeholder="Địa chỉ Email" name="email" required />
						<input type="password" placeholder="Mật khẩu chứa ít nhất 6 ký tự" name="password" required />
						<input type="tel" placeholder="Số điện thoại" name="phone" required />
						<button type="submit" class="btn btn-default">Đăng ký</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection