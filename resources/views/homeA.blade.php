<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<!DOCTYPE html>

<head>
    <title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->

    <!-- Custom CSS -->
    <link href="{{ asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css" />
    <!-- <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/backend/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->

    <!-- DataTable -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/dataTables.dataTables.min.css') }}" type="text/css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <!-- //DataTable -->

    <!-- jquery UI CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/themes/base/jquery-ui.min.css" integrity="sha512-8PjjnSP8Bw/WNPxF6wkklW6qlQJdWJc/3w/ZQPvZ/1bjVDkrrSqLe9mfPYrMxtnzsXFPc434+u4FHLnLjXTSsg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- //jquery UI CSS -->

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.min.js"></script> -->

    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('public/backend/js/morris.js') }}"></script>
    <!-- <script src="{{ asset('public/backend/ckeditor5-build-classic-41.1.0/ckeditor.js') }}"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script> <!-- ckeditor -->


</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{ URL::to('/admin/home') }}" class="logo">
                    VISITORS

                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success">8</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <p class="">You have 8 pending tasks</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>25% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="45">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Product Delivery</h5>
                                            <p>45% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="78">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Payment collection</h5>
                                            <p>87% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="60">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>33% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="90">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-important">4</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="red">You have 4 Mails</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="{{ asset('public/backend/images/3.png') }}"></span>
                                    <span class="subject">
                                        <span class="from">Jonathan Smith</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="{{ asset('public/backend/images/1.png') }}"></span>
                                    <span class="subject">
                                        <span class="from">Jane Doe</span>
                                        <span class="time">2 min ago</span>
                                    </span>
                                    <span class="message">
                                        Nice admin template
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="{{ asset('public/backend/images/3.png') }}"></span>
                                    <span class="subject">
                                        <span class="from">Tasi sam</span>
                                        <span class="time">2 days ago</span>
                                    </span>
                                    <span class="message">
                                        This is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="{{ asset('public/backend/images/2.png') }}"></span>
                                    <span class="subject">
                                        <span class="from">Mr. Perfect</span>
                                        <span class="time">2 hour ago</span>
                                    </span>
                                    <span class="message">
                                        Hi there, its a test
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="fa fa-bell-o"></i>
                            <span class="badge bg-warning">3</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <p>Notifications</p>
                            </li>
                            <li>
                                <div class="alert alert-info clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #1 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-danger clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #2 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-success clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #3 overloaded.</a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('public/backend/images/2.png') }}">
                            <span class="username">
                                <?php

                                use Illuminate\Support\Facades\Session;
                                use Illuminate\Support\Facades\Auth;
                                // $name = Session::get('name_admin');
                                $name = Auth::user()->name_admin;
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a onclick="return confirm('Bạn có muốn Đăng Xuất khỏi tài khoản hiện tại không?')" href="{{ URL::to('/logoutAdmin') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{ URL::to('/admin/home') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Loại sản phẩm</span>
                            </a>
                            <ul class="sub">
                                @hasrole(['Admin', 'Author'])
                                <li><a href="{{ URL::to('/admin/show-add-brand') }}">Thêm loại sản phẩm</a></li>
                                @endhasrole
                                <li><a href="{{ URL::to('/admin/show-all-brand') }}">Liệt kê loại sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                @hasrole(['Admin', 'Author'])
                                <li><a href="{{ URL::to('/admin/show-add-category-product') }}">Thêm Danh mục sản phẩm</a></li>
                                @endhasrole
                                <li><a href="{{ URL::to('/admin/show-all-category-product') }}">Liệt kê danh mục sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa-brands fa-product-hunt"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                @hasrole(['Admin', 'Author'])
                                <li><a href="{{ URL::to('/admin/show-add-type-product') }}">Thêm Sản phẩm</a></li>
                                @endhasrole
                                <li><a href="{{ URL::to('/admin/show-all-product') }}">Liệt kê Sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa-solid fa-ticket"></i>
                                <span>Mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                @hasrole(['Admin', 'Author'])
                                <li><a href="{{ URL::to('/admin/show-add-coupon') }}">Thêm Mã giảm giá</a></li>
                                @endhasrole
                                <li><a href="{{ URL::to('/admin/show-all-coupon') }}">Liệt kê Mã giảm giá</a></li>
                            </ul>
                        </li>
                        <!-- <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa-solid fa-truck"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                @hasrole(['Admin', 'Author'])
                                <li><a href="{{ URL::to('/admin/show-add-delivery') }}">Thêm Phí vận chuyển (1)</a></li>
                                @endhasrole
                                <li><a href="{{ URL::to('/admin/show-add-delivery2') }}">Thêm phí vận chuyển (2)</a></li>
                            </ul>
                        </li> -->
                        <li>
                            <a href="{{ URL::to('/admin/show-add-delivery2') }}">
                                <i class="fa-solid fa-truck"></i>
                                <span>Vận chuyển</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/admin/show-order/wait') }}">
                                <i class="fa-solid fa-receipt"></i>
                                <span>Đơn hàng</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/admin/show-comment/waiting') }}">
                                <i class="fas fa-comments"></i>
                                <span>Bình luận</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/admin/show-contact/waiting') }}">
                                <i class="fa-solid fa-comment"></i>
                                <span>Liên hệ</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa-solid fa-sliders"></i>
                                <span>Banner</span>
                            </a>
                            <ul class="sub">
                                @hasrole(['Admin', 'Author'])
                                <li><a href="{{ URL::to('/admin/show-add-banner') }}">Thêm Banner</a></li>
                                @endhasrole
                                <li><a href="{{ URL::to('/admin/show-all-banner') }}">Tất cả Banner</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa-solid fa-filter"></i>
                                <span>Lọc</span>
                            </a>
                            <ul class="sub">
                                @hasrole(['Admin', 'Author'])
                                <li><a href="{{ URL::to('/admin/show-add-sort') }}">Thêm Lọc</a></li>
                                @endhasrole
                                <li><a href="{{ URL::to('/admin/show-all-sort') }}">Tất cả loại Loc</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa-solid fa-newspaper"></i>
                                <span>Tin tức</span>
                            </a>
                            <ul class="sub">
                                @hasrole(['Admin', 'Author'])
                                <li><a href="{{ URL::to('/admin/show-add-post') }}">Thêm Bài viết</a></li>
                                <li><a href="{{ URL::to('/admin/show-add-tag-post') }}">Thêm Mục Bài viết</a></li>
                                @endhasrole
                                <li><a href="{{ URL::to('/admin/show-all-post') }}">Tất cả Bài viết</a></li>
                            </ul>
                        </li>
                        @hasrole('Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa-solid fa-hat-cowboy"></i>
                                <span>Quyền truy cập</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/admin/show-add-role') }}">Thêm Quyền truy cập</a></li>
                                <li><a href="{{ URL::to('/admin/show-all-role') }}">Tất cả Quyền của Tài khoản Admin</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa-solid fa-user-tie"></i>
                                <span>Admin</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/admin/show-add-admin') }}">Thêm Tài khoản Admin</a></li>
                                <li><a href="{{ URL::to('/admin/show-all-admin') }}">Tất cả Tài khoản Admin</a></li>
                            </ul>
                        </li>
                        @endhasrole
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-th"></i>
                                <span>Data Tables</span>
                            </a>
                            <ul class="sub">
                                <li><a href="basic_table.html">Basic Table</a></li>
                                <li><a href="responsive_table.html">Responsive Table</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>Form Components</span>
                            </a>
                            <ul class="sub">
                                <li><a href="form_component.html">Form Elements</a></li>
                                <li><a href="form_validation.html">Form Validation</a></li>
                                <li><a href="dropzone.html">Dropzone</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-envelope"></i>
                                <span>Mail </span>
                            </a>
                            <ul class="sub">
                                <li><a href="mail.html">Inbox</a></li>
                                <li><a href="mail_compose.html">Compose Mail</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                            </a>
                            <ul class="sub">
                                <li><a href="chartjs.html">Chart js</a></li>
                                <li><a href="flot_chart.html">Flot Charts</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>Maps</span>
                            </a>
                            <ul class="sub">
                                <li><a href="google_map.html">Google Map</a></li>
                                <li><a href="vector_map.html">Vector Map</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-glass"></i>
                                <span>Extra</span>
                            </a>
                            <ul class="sub">
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="404.html">404 Error</a></li>
                                <li><a href="registration.html">Registration</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="login.html">
                                <i class="fa fa-user"></i>
                                <span>Login Page</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('adminContent')
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js') }}"></script><![endif]-->
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.js')}}"></script> <!--Sweet Alert-->
    <script src="{{ asset('public/backend/js/simple.money.format.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js" integrity="sha512-Ww1y9OuQ2kehgVWSD/3nhgfrb424O3802QYP/A5gPXoM4+rRjiKrjHdGxQKrMGQykmsJ/86oGdHszfcVgUr4hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        // Delivery
        $(document).ready(function() {
            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/all-delivery')}}",
                    method: "POST",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        // alert(data);
                        $('#load-delivery').html(data);
                    }
                });
            }
            $(document).on('blur', '.edit-fee-ship', function() {
                var id_fee = $(this).data('id-fee');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                // alert(id_fee); alert(fee_value);
                $.ajax({
                    url: "{{url('/admin/update-delivery')}}",
                    method: "POST",
                    data: {
                        id_fee: id_fee,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        // alert(data);
                        fetch_delivery();
                    }
                });
            });
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

            $('.add-delivery').click(function() {
                var city = $('.choose-city').val();
                var province = $('.choose-province').val();
                var wards = $('.choose-wards').val();
                var fee = $('.fee-price').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/add-delivery')}}",
                    method: "POST",
                    data: {
                        city: city,
                        province: province,
                        wards: wards,
                        fee: fee,
                        _token: _token
                    },
                    success: function(data) {
                        alert("Thêm phí vận chuyển thành công");
                        fetch_delivery();
                    }
                });

            });
        });
    </script>
    <script type="text/javascript">
        // Delivery2
        $(document).ready(function() {
            fetch_delivery2();

            function fetch_delivery2() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/all-delivery2')}}",
                    method: "POST",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        // alert(data);
                        $('#load-delivery2').html(data);
                    }
                });
            }
            $(document).on('blur', '.edit-fee-ship2', function() {
                var id_fee = $(this).data('id-fee');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                // alert(id_fee); alert(fee_value);
                $.ajax({
                    url: "{{url('/admin/update-delivery2')}}",
                    method: "POST",
                    data: {
                        id_fee: id_fee,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        // alert(data);
                        fetch_delivery2();
                    }
                });
            });

            $('.add-delivery2').click(function() {
                var city = $('.choose-city').val();
                var fee = $('.fee-price').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/add-delivery2')}}",
                    method: "POST",
                    data: {
                        city: city,
                        fee: fee,
                        _token: _token
                    },
                    success: function(data) {
                        // alert("Thêm phí vận chuyển thành công");
                        fetch_delivery2();
                    }
                });

            });
        });
    </script>

    <script type="text/javascript">
        //choose address ajax
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
        });
    </script>

    <script type="text/javascript">
        // DataTable
        $(document).ready(function() {
            let table = new DataTable('#tableAllBrand');
            let table2 = new DataTable('#tableAllCategory');
            let table3 = new DataTable('#tableAllCoupon');
            let table4 = new DataTable('#tableAllProduct');
            let table5 = new DataTable('#tableAllPost');
            let table6 = new DataTable('#tableAllTagPost');
            let table7 = new DataTable('#tableAllBanner');
            let table8 = new DataTable('#tableAllAdmin');
            let table9 = new DataTable('#tableAllRole');
            let table10 = new DataTable('#tableComment');
            let table11 = new DataTable('#tableAllSort');
            let table12 = new DataTable('#tableAllOrder');
        });
    </script>

    <script type="text/javascript">
        // simple money format
        $(document).ready(function() {
            $('.money-format').simpleMoneyFormat();
        });

        function checkNumber(input) {
            var val = input.value;
            var check = val.replace(/,/g, '');
            var errorMessId = '#' + input.dataset.price + '_error';
            if (isNaN(check)) {
                $(input).css('border-color', 'red');
                $(errorMessId).text('Vui lòng nhập số.').show();
            } else {
                $(input).css('border-color', ''); // Reset border color
                $(errorMessId).hide(); // Hide error message
            }
        }
    </script>

    <script type="text/javascript">
        // Datepicker
        $(document).ready(function() {
            chart30daysOrder()

            $("#datepicker_from_date").datepicker({
                prevText: 'Tháng trước',
                nextText: 'Tháng sau',
                dateFormat: 'yy-mm-dd',
                dayNamesMin: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật']
            });
            $("#datepicker_to_date").datepicker({
                prevText: 'Tháng trước',
                nextText: 'Tháng sau',
                dateFormat: 'yy-mm-dd',
                dayNamesMin: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật']
            });

            var chart = new Morris.Area({
                element: 'myFirstChart_salesStatistic',
                lineColors: ['#819C79', '#fc8710', '#ff6541', '#a4add3', '#766b56'],
                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                parseTime: false,
                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                behaveLikeLine: true,
                labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
            });

            function chart30daysOrder() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/filter-by-30days')}}",
                    method: "POST",
                    dataType: 'JSON',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        // alert(data);
                        chart.setData(data);
                    }
                });
            }
            $('.filter-by-preset-time').change(function() {
                var _token = $('input[name="_token"]').val();
                var interval = $(this).val();
                $.ajax({
                    url: "{{url('/admin/filter-by-preset')}}",
                    method: "POST",
                    dataType: 'JSON',
                    data: {
                        interval: interval,
                        _token: _token
                    },
                    success: function(data) {
                        // alert(data);
                        chart.setData(data);
                    }
                });
            });
            $('#btn_filter_by_selected_date').click(function() {
                var _token = $('input[name="_token"]').val();
                var from = $('#datepicker_from_date').val();
                var to = $('#datepicker_to_date').val();
                $.ajax({
                    url: "{{url('/admin/filter-by-date')}}",
                    method: "POST",
                    dataType: 'JSON',
                    data: {
                        from: from,
                        to: to,
                        _token: _token
                    },
                    success: function(data) {
                        // alert(data);
                        chart.setData(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        // statistic pop (product - order - post)
        $(document).ready(function() {
            chartPOP();

            function chartPOP() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/chartPOP')}}",
                    method: "POST",
                    dataType: 'JSON',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        var chartData = [];
                        $.each(data, function(label, value) {
                            chartData.push({
                                label: label,
                                value: value
                            });
                        });
                        var colorDanger = "#FF1744";
                        var donut = new Morris.Donut({
                            element: 'mySecondChart_popStatistic',
                            resize: true,
                            colors: [
                                '#ccccff',
                                '#e4433f',
                                '#ffeb7f',
                                '#ffc0cb',
                                '#80DEEA',
                            ],
                            //labelColor:"#cccccc", // text color
                            //backgroundColor: '#333333', // border color
                            data: chartData
                        });
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">
        //detail comment
        $(document).ready(function() {
            $(document).on('click', '.detail-comment', function() {
                var id_comment = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/detail-comment')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        id_comment: id_comment,
                        _token: _token
                    },
                    success: function(data) {
                        $('#info_name_comment').html(data.name);
                        $('#info_email_comment').html(data.email);
                        $('#info_product_comment').html(data.product);
                        $('#info_client_comment').html(data.client);
                        $('#info_admin_comment').html(data.admin);
                        $('#info_status_comment').html(data.status);
                        $('#info_created_comment').html(data.created);
                        $('#info_content_comment').html(data.content);
                        $('#info_admin_rep_comment').html(data.html_rep);
                        $('#info_rep_comment').html(data.rep);
                    }
                });
            });

            $(document).on('click', '.btn-rep-comment', function() { //rep comment
                var id_comment = $(this).data('id');
                var rep = $('#ipt_admin_rep_comment').val();
                var _token = $('input[name="_token"]').val();

                if (rep == '') {
                    alert('Nội dung trả lời trống!');
                } else {
                    $.ajax({
                        url: "{{url('/admin/rep-comment')}}",
                        method: "POST",
                        data: {
                            id_comment: id_comment,
                            rep: rep,
                            _token: _token
                        },
                        success: function(data) {
                            $('#notify_rep_comment').html(data.rep);
                            $('#info_rep_comment').html(data.rep);
                        }
                    });
                }
            });
        });
    </script>

    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{ asset('public/backend/js/monthly.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <!-- //calendar -->
    @yield('js-custom')
</body>

</html>