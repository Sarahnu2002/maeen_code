<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مَعين </title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/animate-3.7.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-4.7.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-4.1.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
<header class="header-area">
{{--    <div class="header-top">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-9 d-md-flex">--}}
{{--                    <h6 class="mr-3"><span class="mr-2"><i class="fas fa-phone-square"></i></span> اتصل بنا: +966 123 456 789</h6>--}}
{{--                    <h6 class="mr-3"><span class="mr-2"><i class="fas fa-envelope-square"></i></span> support@maeen.com</h6>--}}
{{--                    <h6><span class="mr-2"><i class="fas fa-map-marker"></i></span> موقعنا: السعودية، نجران</h6>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3">--}}
{{--                    <div class="social-links">--}}
{{--                        <ul class="d-flex list-unstyled m-0">--}}
{{--                            <li>--}}
{{--                                <a href="#" class="social-icon ">--}}
{{--                                    <i class="fab fa-facebook"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="social-icon ">--}}
{{--                                    <i class="fab fa-twitter"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="social-icon ">--}}
{{--                                    <i class="fab fa-instagram"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
        <div id="header">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <a href="{{ route('home') }}">
                            {{-- <img src="{{ asset('logo.png') }}" alt="مَعين" title="مَعين"> --}}
                            <strong class="logoText">مَعين</strong>
                        </a>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">الرئيسية</a></li>
                            <li class="nav-item"><a href="#services" class="nav-link {{ request()->is('services') ? 'active' : '' }}">خدماتنا</a></li>
                            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">عن مَعين </a></li>
                            <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}"> تواصل معنا</a></li>
                            <li class="nav-item"><a href="{{ route('join') }}" class="nav-link {{ request()->is('join') ? 'active' : '' }}">انضم إلينا الآن</a></li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle align-items-center" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{--                                    <img src="{{ asset('assets/images/' . (app()->getLocale() == 'ar' ? 'ar.png' : 'en.png')) }}" alt="اللغة" class="lang-flag">--}}
                                    {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                                </a>
                                <div class="dropdown-menu " aria-labelledby="languageDropdown">
                                    <a href="#" class="dropdown-item">
                                        <img src="{{ asset('assets/images/ar.png') }}" alt="العربية" class="lang-flag"> العربية
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <img src="{{ asset('assets/images/en.png') }}" alt="English" class="lang-flag"> English
                                    </a>
                                </div>
                            </li>
                        </ul>

                    </nav>
                    <div class="search-container d-flex align-items-center">
                        <input type="search" class="form-control search-input" placeholder="ابحث هنا..." aria-label="ابحث هنا">
                        <button class="btn search-btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</header>

<!-- نهاية شريط التنقل -->

<!-- المحتوى الرئيسي -->
@yield('content')

<!-- الفوتر -->
<footer class="footer-area section-padding text-white">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4">
                <h3 class="mb-4">مَعين</h3>
                <p>منصة متكاملة لإدارة الأدوية، تقدم حلولًا ذكية وآمنة للأطباء، الصيادلة، والمرضى.</p>
            </div>
            <div class="col-xl-4 col-lg-4">
                <h3 class="mb-4">روابط سريعة</h3>
                <ul class="list-unstyled">
                    <li><a href="{{ route('about') }}" class="text-white">عن مَعين</a></li>
                    <li><a href="#services" class="text-white">خدماتنا</a></li>
                    <li><a href="{{ route('join') }}" class="text-white">انضم إلينا</a></li>
                </ul>
            </div>
            <div class="col-xl-4 col-lg-4">
                <h3 class="mb-4">اتصل بنا</h3>
                <p><i class="fa fa-phone"></i> +966 123 456 789</p>
                <p><i class="fa fa-envelope"></i> support@maeen.com</p>
                <p><i class="fa fa-map-marker"></i> السعودية، نجران</p>
            </div>
            <p class="copppy">&copy; 2025 جميع الحقوق محفوظة - مَعين</p>

        </div>
    </div>
</footer>

<!-- ملفات JavaScript -->
<script src="{{ asset('assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="{{ asset('assets/js/vendor/bootstrap-4.1.3.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/owl-carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/superfish.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
