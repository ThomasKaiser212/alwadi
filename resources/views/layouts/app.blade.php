<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الفندق</title>
    <!-- Include Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Include Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Ensure the page takes up the full height */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            text-align: center;
            width: 100%;
            margin-top: auto; /* Pushes footer to the bottom */
        }

        .card {
            border: 1px solid #6c757d; /* Gray border color */
            border-radius: 10px; /* Rounded corners */
        }

        .card-img-top {
            border-top-left-radius: 10px; /* Match card's rounded corners */
            border-top-right-radius: 10px; /* Match card's rounded corners */
        }

        .status-bar {
            background-color: #343a40;
            color: white;
            font-size: 0.9rem;
            padding: 0.5rem 0;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 1rem 0;
        }

        .header h4 {
            margin: 0;
        }

        .navbar {
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            color: #007bff;
            font-family: 'Pacifico', cursive;
            font-size: 20px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .navbar-nav .nav-link {
            color: #007bff;
            font-size: 14px; /* Smaller text size */
        }

        .navbar-nav .nav-link:hover {
            color: #0056b3;
        }

        .navbar-toggler-icon {
            background-color: #007bff; /* Toggler icon color */
        }

        .social-icons li {
            display: inline-block;
            margin-right: 10px;
        }

        .social-icons li a {
            color: #007bff; /* Blue color for social icons */
            font-size: 1.2rem; /* Smaller icon size */
        }

        /* Custom styles for tabs */
        .nav-tabs .nav-link {
            color: #007bff; /* Default tab color */
            font-size: 14px; /* Smaller text size */
        }

        .nav-tabs .nav-link.active {
            background-color: #e9ecef; /* Light background for active tab */
            color: #007bff; /* Highlighted text color */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <!-- Combined Header and Navigation Bar -->
        <header class="header">
            <div class="container">
                <h4 class="text-center mb-0">الرئيسية</h4>
            </div>
        </header>

        <div class="status-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">حالة الحجز: متاح</p>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <p class="mb-0">مرحبا بك في فندقنا</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Centro Hotel
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rooms.index') }}">حجز الغرف</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reserve-table.index') }}">حجز الطاولات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order-meal.index') }}">حجز وجبات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reserve-car.index') }}">حجز سيارات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('my-bookings') }}">طلباتي</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">الرئيسية</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('انشاء حساب') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('تسجيل الخروج') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Centro Hotel
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">الرئيسية</a>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('rooms.index') ? 'active' : '' }}" href="{{ route('rooms.index') }}">حجز الغرف</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('reserve-table.index') ? 'active' : '' }}" href="{{ route('reserve-table.index') }}">حجز الطاولات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('order-meal.index') ? 'active' : '' }}" href="{{ route('order-meal.index') }}">حجز وجبات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('reserve-car.index') ? 'active' : '' }}" href="{{ route('reserve-car.index') }}">حجز سيارات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('my-bookings') ? 'active' : '' }}" href="{{ route('my-bookings') }}">طلباتي</a>
                        </li>
                        <li class="nav-item">
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('انشاء حساب') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('تسجيل الخروج') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success" role="alert" style="display: inline-block;">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3>روابط سريعة</h3>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('rooms.index') }}">الغرف</a></li>
                        <li><a href="{{ route('order-meal.index') }}">الوجبات</a></li>
                        <li><a href="{{ route('reserve-table.index') }}">الطاولات</a></li>
                        <li><a href="{{ route('home') }}">الخدمات</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h3>تواصل معنا</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">+1234567890</a></li>
                        <li><a href="#">info@yourhotel.com</a></li>
                        <li><a href="#">العنوان: شارع المثال، المدينة، البلد</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h3>متابعتنا على الشبكات الاجتماعية</h3>
                    <ul class="list-unstyled list-inline social-icons">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
