@extends('website.app')

@section('content')

    <!-- منطقة البانر -->
    <section class="banner-area1 other-page mtop">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img src="{{ asset('assets/images/bg.png') }}" alt="تواصل معنا" class="banner-image1">
                </div>
                <div class="col-lg-1 text-center">
                    <div class="vertical-line"></div>
                </div>
                <div class="col-lg-6">
                    <h1>تواصل معنا</h1>
                    <p class="banner-text1">هل لديك استفسار؟ لا تتردد في التواصل معنا، فريقنا جاهز لمساعدتك على مدار الساعة.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- معلومات الاتصال -->
    <section class="contact-info section-padding">
        <div class="container text-center">
            <h2 class="section-title">معلومات الاتصال</h2>
            <p class="section-subtitle">يمكنك التواصل معنا عبر الوسائل التالية:</p>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact card py-5">
                        <i class="fas fa-phone-alt fontfa"></i>
                        <h4>الهاتف</h4>
                        <p>+966 1234 56789</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact card py-5">
                        <i class="fas fa-envelope fontfa"></i>
                        <h4>البريد الإلكتروني</h4>
                        <p>support@maeen.com</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact card py-5">
                        <i class="fas fa-map-marker-alt fontfa"></i>
                        <h4>الموقع</h4>
                        <p>المملكة العربية السعودية، نجران</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
