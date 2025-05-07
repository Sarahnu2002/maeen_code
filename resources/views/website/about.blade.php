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
                    <h1> عن مَعين</h1>
                    <p class="banner-text1">اكتشف كيف يعمل "مَعين" على تحسين إدارة الأدوية وضمان سلامة المرضى من خلال التكنولوجيا الحديثة.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- قسم الترحيب -->
    <section class="welcome-area section-padding">
        <div class="container">
            <div class="row text-center m-auto">
{{--                <div class="col-lg-5 align-self-center">--}}
{{--                    <div class="welcome-img">--}}
{{--                        <img src="{{ asset('assets/images/welcome.png') }}" alt="مَعين">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-12">
                    <div class="welcome-text mt-5 mt-lg-0">
                        <h2>مرحبًا بكم في مَعين</h2>
                        <p class="pt-3">مَعين هو نظام متطور لإدارة الأدوية والوصفات الطبية، يهدف إلى تحسين دقة صرف الأدوية وتقليل الأخطاء الدوائية.</p>
                        <p>نحن نقدم حلولًا ذكية وآمنة للمستشفيات والصيدليات والمرضى، لضمان تجربة طبية أكثر أمانًا وسهولة.</p>
                        <a href="{{ route('services') }}" class="template-btn mt-3">تعرف على خدماتنا</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم القيم والمبادئ -->
    <section class="values-area section-padding bg-light mb-5 pb-5">
        <div class="container text-center">
            <h2 class="section-title">قيمنا ومبادئنا</h2>
            <p class="section-subtitle">نلتزم بتقديم حلول رعاية صحية آمنة وموثوقة للجميع.</p>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-value card py-5">
                        <i class="fas fontfa fa-user-shield"></i>
                        <h4>الأمان والموثوقية</h4>
                        <p>نضمن بيئة آمنة وصحيحة لإدارة الوصفات الطبية وتقليل الأخطاء.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-value card py-5">
                        <i class="fas fontfa fa-hand-holding-heart"></i>
                        <h4>رعاية متكاملة</h4>
                        <p>نعمل على تقديم خدمات تساعد المرضى في تلقي الرعاية الطبية المثلى.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-value card py-5">
                        <i class="fas fontfa fa-cogs"></i>
                        <h4>التكنولوجيا المتقدمة</h4>
                        <p>نستخدم أحدث التقنيات لضمان أفضل حلول إدارة الأدوية.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- فريق التطوير -->

@endsection
