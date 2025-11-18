<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('admin/img/caphe.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    <!-- SIDEBAR -->
    <div class="sidebar" data-color="white" data-active-color="danger">
        <div class="logo">
            <a href="#" class="simple-text logo-normal">
                <div class="logo-image-big">
                    <img src="{{ asset('admin/img/logo.png') }}">
                </div>
            </a>
        </div>

        <!-- Sidebar menu -->
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ Request::is('backend') ? 'active' : '' }}">
                    <a href="{{ url('/backend') }}"><i class="fa fa-home"></i><p>Trang chủ</p></a>
                </li>
                <li class="{{ Request::is('backend/categories*') ? 'active' : '' }}">
                    <a href="{{ url('backend/categories') }}"><i class="fa fa-table"></i><p>Danh mục sản phẩm</p></a>
                </li>
                <li class="{{ Request::is('backend/products*') ? 'active' : '' }}">
                    <a href="{{ url('backend/products') }}"><i class="fa fa-list"></i><p>Danh sách sản phẩm</p></a>
                </li>
                <li class="{{ Request::is('backend/news*') ? 'active' : '' }}">
                    <a href="{{ url('backend/news') }}"><i class="fa fa-newspaper-o"></i><p>Tin tức</p></a>
                </li>
                <li class="{{ Request::is('backend/orders*') ? 'active' : '' }}">
                    <a href="{{ url('backend/orders') }}"><i class="fa fa-shopping-cart"></i><p>Đơn hàng</p></a>
                </li>
                <li class="{{ Request::is('backend/banner*') ? 'active' : '' }}">
                    <a href="{{ url('backend/banner') }}"><i class="fa fa-image"></i><p>Banner</p></a>
                </li>
                <li class="{{ Request::is('backend/users*') ? 'active' : '' }}">
                    <a href="{{ url('backend/users') }}"><i class="fa fa-user"></i><p>Admin</p></a>
                </li>
                <li class="{{ Request::is('backend/customers*') ? 'active' : '' }}">
                    <a href="{{ url('backend/customers') }}"><i class="fa fa-users"></i><p>Khách hàng</p></a>
                </li>
                <li>
                    <a href="{{ url('backend/logout') }}"><i class="fa fa-sign-out"></i><p>Đăng xuất</p></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- MAIN PANEL -->
    <div class="main-panel">
        @include('admin.layouts.admin_navbar')
        <div class="content">
            @yield('content')
        </div>

        @include('admin.layouts.admin_footer')
    </div>
</div>

<!-- JS -->
<script src="{{ asset('admin/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
@yield('scripts')
</body>
</html>
