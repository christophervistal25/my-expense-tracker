<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    @stack('page-css')

    @vite(['resources/js/app.js'])
    <style>
        * {
            font-family: 'Inter', sans-serif !important;
        }
    </style>
</head>

<body class="dark-sidenav">
    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <!-- LOGO -->
        <div class="brand">
            <a href="index.html" class="logo">
                <span>
                    <img src="{{ asset('/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
                </span>
                <span>
                    <img src="{{ asset('/assets/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light">
                    <img src="{{ asset('/assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li class="menu-label mt-0">Main</li>
                <li>
                    <a href="{{ route('home') }}"> <i data-feather="home"
                            class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{ route('transactions.index') }}"> <i data-feather="dollar-sign"
                            class="align-self-center menu-icon"></i><span>Transactions</span></a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}"> <i data-feather="list"
                            class="align-self-center menu-icon"></i><span>Categories</span></a>
                </li>
                <li>
                    <a href="{{ route('bills.index') }}"> <i data-feather="credit-card"
                            class="align-self-center menu-icon"></i><span>Bills & Debts</span></a>
                </li>
                <li>
                    <a href="javascript: void(0);"> <i data-feather="pie-chart"
                            class="align-self-center menu-icon"></i><span>Reports</span></a>
                </li>
                {{-- <li>
                    <a href="javascript: void(0);"><i data-feather="lock"
                            class="align-self-center menu-icon"></i><span>Authentication</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="auth-login.html"><i
                                    class="ti-control-record"></i>Log in</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-register.html"><i
                                    class="ti-control-record"></i>Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-recover-pw.html"><i
                                    class="ti-control-record"></i>Recover Password</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-lock-screen.html"><i
                                    class="ti-control-record"></i>Lock Screen</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-404.html"><i
                                    class="ti-control-record"></i>Error 404</a></li>
                        <li class="nav-item"><a class="nav-link" href="auth-500.html"><i
                                    class="ti-control-record"></i>Error 500</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- Navbar -->
            <nav class="navbar-custom">
                <ul class="list-unstyled topbar-nav float-end mb-0">


                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="ms-1 nav-user-name hidden-sm text-uppercase">{{ auth()->user()->name }}</span>
                            <img src="{{ asset('/assets/images/users/user-5.jpg') }}" alt="profile-user"
                                class="rounded-circle thumb-xs" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">

                            <form action="{{ route('logout') }}" method="POST">
                                <div class="dropdown-item">
                                    <a class="btn btn-transparent" href="#">
                                        <i data-feather="power" class="align-self-center icon-xs icon-dual"></i>
                                        Profile
                                    </a>
                                </div>
                                <div class="dropdown-divider mb-0"></div>
                                <div class="dropdown-item">
                                    <button type="submit" class="btn btn-transparent">
                                        <i data-feather="power" class="align-self-center icon-xs icon-dual"></i>
                                        Logout
                                    </button>
                                </div>
                            </form>

                        </div>
                    </li>
                </ul><!--end topbar-nav-->

                <ul class="list-unstyled topbar-nav mb-0">
                    <li>
                        <button class="nav-link button-menu-mobile">
                            <i data-feather="menu" class="align-self-center topbar-icon"></i>
                        </button>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row">
                                <div class="col">
                                    <h4 class="page-title">@yield('page-title')</h4>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end page-title-box-->
                    </div><!--end col-->
                </div><!--end row-->
                <!-- end page title end breadcrumb -->

                @yield('content')
            </div><!-- container -->

            <footer class="footer text-center text-sm-start">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> {{ config('app.name') }} <span class="text-muted d-none d-sm-inline-block float-end">Crafted
                    with <i class="mdi mdi-heart text-danger"></i> by Dev Kuno</span>
            </footer><!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->




    <!-- jQuery  -->
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('/assets/js/waves.js') }}"></script>
    <script src="{{ asset('/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('/assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/moment.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('/assets/js/app.js') }}"></script>
    <script>
        let notyf = new Notyf();
    </script>
    @stack('page-scripts')

</body>


</html>
