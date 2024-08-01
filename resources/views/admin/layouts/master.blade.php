<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>ShopMM</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    {{-- font awesome  --}}
    <script src="https://kit.fontawesome.com/17730cb0db.js" crossorigin="anonymous"></script>

    {{-- chart list  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="animsition">
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <h2 class="navbar-brand">
                ShopMM
            </h2>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list tabs" id="">
                    <li class=" has-sub tab1">
                        <a class="js-arrow nav-link" href="/dashboard">
                            <i class="fa-solid fa-house"></i>Dashboard
                        </a>
                    </li>

                    <li class="nav-link tab2">
                        <a class="js-arrow nav-link" href="/customer/list">
                            <i class="fa-solid fa-user-tie"></i>Customer
                        </a>
                    </li>

                    <li class="nav-link tab3">
                        <a class="js-arrow nav-link" href="/category/list">
                            <i class="fa-solid fa-list"></i>Category
                        </a>
                    </li>

                    <li class="nav-link tab4">
                        <a class="js-arrow nav-link" href="/product/list">
                            <i class="fa-solid fa-burger"></i> Products
                        </a>
                    </li>

                    <li class="nav-link tab8">
                        <a class="js-arrow nav-link" href="/order/list">
                            <i class="fa-solid fa-folder"></i> Order
                        </a>
                    </li>

                    <li class="nav-link tab5">
                        <a class="js-arrow nav-link" href="/chat/list">
                            <i class="fa-solid fa-comment-dots"></i> Chat Box
                        </a>
                    </li>

                    <li class="nav-link tab6">
                        <a class="js-arrow nav-link" href="/admin/list">
                            <i class="fa-solid fa-user-tie"></i> Admin List
                        </a>
                    </li>

                    <li class="nav-link tab7">
                        <a class="js-arrow nav-link" href="/setting/manage">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a class="js-arrow nav-link" href="{{ route('logout') }}">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="header-wrap">
                    <h3 class="mb-2">Admin Dashboard</h3>

                    <div class="header-button">
                        <div class="noti-wrap">
                            <div class="mx-3">{{ Auth::user()->name }}</div>
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                        <img src="{{ asset('admin/images/profileMale.jpg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>
    <!-- HEADER DESKTOP-->
    @yield('content')

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    {{-- jquery cdn  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>
@yield('scriptSource')
<script>
    $(document).ready(function() {
        $path = window.location.pathname;
        if ($path == '/dashboard') {
            $('.tab1').addClass('active')
        } else if ($path == '/customer/list') {
            $('.tab2').addClass('active')
        } else if ($path == '/category/list') {
            $('.tab3').addClass('active')
        } else if ($path == '/product/list') {
            $('.tab4').addClass('active')
        } else if ($path == '/chat/list') {
            $('.tab5').addClass('active')
        } else if ($path == '/admin/list') {
            $('.tab6').addClass('active')
        } else if ($path == '/setting/manage' || $path == '/setting/editProfile') {
            $('.tab7').addClass('active')
        } else if ($path == '/order/list' || $path == '/order/detail') {
            $('.tab8').addClass('active')
        }
    })
</script>

</html>
<!-- end document-->
