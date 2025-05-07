<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مَعين </title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@if(app()->getLocale() == 'ar')
        <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="{{asset('admin/css/ar.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{asset('admin/css/main.css')}}">
    @endif

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/confirm.css')}}">

    @stack('css')
</head>
<body class="app sidebar-mini rtl">
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @php
            toastr()->error($error);
        @endphp
    @endforeach
@endif
<header class="app-header"><a class="app-header__logo" href="#">
        <img height="66px" src="{{asset('logo.png')}}" class="logo" alt="" />
    </a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                <i class="fa fa-bell"></i>
            </a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                <li class="app-notification__title">الإشعارات </li>
                <div class="app-notification__content"></div>
            </ul>
        </li>

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                    class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="#" onclick="confirmationLogout('FormLogout')"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                <form id="FormLogout" class="d-none" action="{{route('admin.logout')}}" method="post">@csrf</form>
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img height="50px;" class="app-sidebar__user-avatar" src="{{asset('def.png')}}" alt="User Image">
        <div>
            @if(auth()->check())
                <p style="font-size: 14px;margin-bottom: 9px;" class="app-sidebar__user-name text-dark">
                    مرحبا بك : {{ auth()->user()->full_name }}
                </p>
                <p style="font-size: 11px;" class="app-sidebar__user-designation text-dark">
                    @if(auth()->user()->doctor)
                        طبيب
                    @elseif(auth()->user()->pharmacist)
                        صيدلي
                    @elseif(auth()->user()->patient)
                        مريض
                    @else
                        مدير
                    @endif
                </p>
            @else
                <p class="app-sidebar__user-name">مرحباً</p>
                <p class="app-sidebar__user-designation">غير مسجل دخول</p>
            @endif
        </div>
    </div>
    <ul class="app-menu">
        @if(auth()->user()->doctor)
            <li>
                <a class="app-menu__item {{isNavbarActive('doctor/dashboard')}}" href="{{route('doctor.dashboard')}}">
                    <i class="app-menu__icon fa fa-home"></i>
                    <span class="app-menu__label">الرئيسية</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{isNavbarActive('doctor/profile*')}}" href="{{route('doctor.profile.edit')}}">
                    <i class="app-menu__icon fa fa-user"></i>
                    <span class="app-menu__label">الملف الشخصى</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item {{ isNavbarActive('doctor/prescriptions*') }}"
                   href="{{ route('doctor.prescriptions.index') }}">
                    <i class="app-menu__icon fa fa-pencil-square"></i>
                    <span class="app-menu__label">الوصفات</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item {{ isNavbarActive('chat*') }}"
                   href="{{ route('chat.index') }}">
                    <i class="app-menu__icon fa fa-comments"></i>
                    <span class="app-menu__label">الاستشارات</span>
                </a>
            </li>

{{--            <li>--}}
{{--                <a class="app-menu__item {{ isNavbarActive('medications*') }}"--}}
{{--                   href="{{ route('medications.index') }}">--}}
{{--                    <i class="app-menu__icon fa fa-medkit"></i>--}}
{{--                    <span class="app-menu__label">الأدوية</span>--}}
{{--                </a>--}}
{{--            </li>--}}

        @elseif(auth()->user()->pharmacist)
            <li>
                <a class="app-menu__item {{isNavbarActive('pharmacist/dashboard')}}" href="{{route('pharmacist.dashboard')}}">
                    <i class="app-menu__icon fa fa-home"></i>
                    <span class="app-menu__label">الرئيسية</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{isNavbarActive('pharmacist/profile*')}}" href="{{route('pharmacist.profile.edit')}}">
                    <i class="app-menu__icon fa fa-user"></i>
                    <span class="app-menu__label">الملف الشخصى</span>
                </a>
            </li>


            <li>
                <a class="app-menu__item {{ isNavbarActive('medications*') }}"
                   href="{{ route('medications.index') }}">
                    <i class="app-menu__icon fa fa-medkit"></i>
                    <span class="app-menu__label">الأدوية</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item {{isNavbarActive('pharmacist/prescriptions*')}}" href="{{route('pharmacist.prescriptions')}}">
                    <i class="app-menu__icon fa fa-pencil-square"></i>
                    <span class="app-menu__label">  صرف الوصفات الطبية </span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ isNavbarActive('chat*') }}"
                   href="{{ route('chat.index') }}">
                    <i class="app-menu__icon fa fa-comments"></i>
                    <span class="app-menu__label">الاستشارات</span>
                </a>
            </li>


        @elseif(auth()->user()->patient)
            <li>
                <a class="app-menu__item {{isNavbarActive('patient/dashboard')}}" href="{{route('patient.dashboard')}}">
                    <i class="app-menu__icon fa fa-home"></i>
                    <span class="app-menu__label">الرئيسية</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{isNavbarActive('patient/profile*')}}" href="{{route('patient.profile.edit')}}">
                    <i class="app-menu__icon fa fa-user"></i>
                    <span class="app-menu__label">الملف الشخصى</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{isNavbarActive('patient/prescriptions*')}}" href="{{route('patient.prescriptions')}}">
                    <i class="app-menu__icon fa fa-pencil-square"></i>
                    <span class="app-menu__label"> أرشيف وصفاتي</span>
                </a>
            </li>


            <li>
                <a class="app-menu__item {{ isNavbarActive('medications*') }}"
                   href="{{ route('medications.index') }}">
                    <i class="app-menu__icon fa fa-medkit"></i>
                    <span class="app-menu__label">الأدوية</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ isNavbarActive('chat*') }}"
                   href="{{ route('chat.index') }}">
                    <i class="app-menu__icon fa fa-comments"></i>
                    <span class="app-menu__label">الاستشارات</span>
                </a>
            </li>

        @else
            <li>
                <a class="app-menu__item {{isNavbarActive('admin/dashboard')}}" href="{{route('admin.dashboard')}}">
                    <i class="app-menu__icon fa fa-home"></i>
                    <span class="app-menu__label">الرئيسية</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{isNavbarActive('admin/profile*')}}" href="{{route('admin.profile.edit')}}">
                    <i class="app-menu__icon fa fa-user"></i>
                    <span class="app-menu__label">الملف الشخصى</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ isNavbarActive('admin/doctors') }}" href="{{ route('admin.doctors.index') }}">
                    <i class="app-menu__icon fa fa-user-md"></i>
                    <span class="app-menu__label">الأطباء</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item {{ isNavbarActive('admin/pharmacists') }}" href="{{ route('admin.pharmacists.index') }}">
                    <i class="app-menu__icon fa fa-medkit"></i>
                    <span class="app-menu__label">الصيادلة</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item {{ isNavbarActive('admin/patients') }}" href="{{ route('admin.patients.index') }}">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">المرضى</span>
                </a>
            </li>


            <li>
                <a class="app-menu__item {{isNavbarActive('admin/prescriptions*')}}" href="{{route('admin.prescriptions')}}">
                    <i class="app-menu__icon fa fa-pencil-square"></i>
                    <span class="app-menu__label">الوصفات الطبية </span>
                </a>
            </li>
        @endif

            <li>
                <a class="app-menu__item {{ isNavbarActive('checking_medication*') }}" href="{{ route('medications_check') }}">
                    <i class="app-menu__icon fa fa-exclamation-triangle"></i>
                    <span class="app-menu__label">فحص التفاعلات</span>
                </a>
            </li>




    </ul>
</aside>
@yield('content')
<div id="scroller"></div>
@include('admin.footer')
</body>
</html>
