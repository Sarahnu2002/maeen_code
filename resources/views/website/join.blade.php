@extends('website.app')

@section('content')
    <section class="banner-area1 other-page mtop">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img src="{{ asset('assets/images/bg.png') }}" alt="مَعين" class="banner-image1">
                </div>
                <div class="col-lg-1 text-center">
                    <div class="vertical-line"></div>
                </div>
                <div class="col-lg-6">
                    <h1> انضم إلينا الآن</h1>
                    <p class="banner-text1">                        سواء كنت صيدليًا، طبيبًا، أو مريضًا، يمكنك الانضمام إلى "معين" والاستفادة من خدماتنا المميزة.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div id="join" class="bg-light py-5">
        <div class="container">
            <div class="row mt-5 text-center">
                <div class="col-md-6">
                    <div class="p-4 bg-white shadow-lg rounded">
                        <i class="fas fa-sign-in-alt fa-4x text-primary mb-3"></i>
                        <h4 class="text-dark fw-bold">تسجيل الدخول</h4>
                        <p class="text-muted">إذا كنت تمتلك حسابًا بالفعل، قم بتسجيل الدخول للوصول إلى خدماتنا.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">تسجيل الدخول</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 bg-white shadow-lg rounded">
                        <i class="fas fa-user-plus fa-4x text-primary mb-3"></i>
                        <h4 class="text-dark fw-bold">إنشاء حساب جديد</h4>
                        <p class="text-muted">إذا كنت مستخدمًا جديدًا، يمكنك التسجيل والانضمام إلينا الآن.</p>
                        <a href="{{ route('choose_type_register') }}" class="btn btn-primary">التسجيل</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
