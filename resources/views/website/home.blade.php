
@extends('website.app')

@section('content')
{{--    <section class="banner-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-5">--}}
{{--                    <h4>رعاية صحية ذكية</h4>--}}
{{--                    <h1>نحو تجربة طبية أكثر أمانًا وفعالية</h1>--}}
{{--                    <p>منصة "مَعين" توفر أدوات متقدمة لإدارة الأدوية والوصفات الطبية بأمان وسهولة.</p>--}}
{{--                    <a href="{{ route('join') }}" class="template-btn mt-3">انضم إلينا الآن</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
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
                    <h4>رعاية صحية ذكية</h4>
                    <h1>نحو تجربة طبية أكثر أمانًا وفعالية</h1>
                    <p>منصة "مَعين" توفر أدوات متقدمة لإدارة الأدوية والوصفات الطبية بأمان وسهولة.</p>
                    <a href="{{ route('join') }}" class="template-btn mt-3">انضم إلينا الآن</a>
                </div>
            </div>
        </div>
    </section>


{{--    <section  class="statistics-area section-padding bg-light">--}}
{{--        <div class="container">--}}
{{--            <div class="row text-center">--}}
{{--                <!-- وصفة طبية -->--}}
{{--                <div class="col-lg-3 col-md-6">--}}
{{--                    <div class="single-statistics shadow-lg p-4 rounded bg-white">--}}
{{--                        <div class="stat-icon"><i class="fas fa-file-medical"></i></div>--}}
{{--                        <h3 class="stat-number">141.7M</h3>--}}
{{--                        <h3 class="text-muted">وصفة طبية</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- مستشفى -->--}}
{{--                <div class="col-lg-3 col-md-6">--}}
{{--                    <div class="single-statistics shadow-lg p-4 rounded bg-white">--}}
{{--                        <div class="stat-icon"><i class="fas fa-hospital"></i></div>--}}
{{--                        <h3 class="stat-number">239</h3>--}}
{{--                        <h3 class="text-muted">مستشفى</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- صيدلية -->--}}
{{--                <div class="col-lg-3 col-md-6">--}}
{{--                    <div class="single-statistics shadow-lg p-4 rounded bg-white">--}}
{{--                        <div class="stat-icon"><i class="fas fa-prescription-bottle-alt"></i></div>--}}
{{--                        <h3 class="stat-number">5,525</h3>--}}
{{--                        <h3 class="text-muted">صيدلية</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- مدينة ومحافظة -->--}}
{{--                <div class="col-lg-3 col-md-6">--}}
{{--                    <div class="single-statistics shadow-lg p-4 rounded bg-white">--}}
{{--                        <div class="stat-icon"><i class="fas fa-user-md"></i></div>--}}
{{--                        <h3 class="stat-number">172</h3>--}}
{{--                        <h3 class="text-muted">دكتور </h3>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


    <section id="services" class="services-area section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">خدماتنا</h2>
                    <p class="section-subtitle">نقدم حلولاً مبتكرة وآمنة لإدارة الأدوية والوصفات الطبية لضمان سلامة المرضى وتحسين كفاءة الرعاية الصحية.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-service">
                        <div class="service-icon"><i class="fas fa-pills"></i></div>
                        <h4 class="service-title">اكتشاف الأخطاء الدوائية</h4>
                        <p class="service-text">نظام ذكي يكشف الأخطاء الدوائية في الوصفات الطبية ويمنع التداخلات الخطيرة.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-service">
                        <div class="service-icon"><i class="fas fa-exchange-alt"></i></div>
                        <h4 class="service-title">تحليل التفاعلات الدوائية</h4>
                        <p class="service-text">نظام تحليل متقدم يكشف التفاعلات الخطيرة بين الأدوية ويحذر المستخدمين.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-service">
                        <div class="service-icon"><i class="fas fa-notes-medical"></i></div>
                        <h4 class="service-title">إدارة السجلات الطبية</h4>
                        <p class="service-text">توفر المنصة سجلًا طبيًا متكاملاً يتيح للأطباء متابعة حالات المرضى بكفاءة.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-service">
                        <div class="service-icon"><i class="fas fa-bell"></i></div>
                        <h4 class="service-title">تنبيهات تناول الدواء</h4>
                        <p class="service-text">يُرسل التطبيق تنبيهات ذكية لمساعدة المرضى على تناول أدويتهم في المواعيد المحددة.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-service">
                        <div class="service-icon"><i class="fas fa-barcode"></i></div>
                        <h4 class="service-title">فحص الأدوية عبر الباركود</h4>
                        <p class="service-text">يمكن للمستخدمين التحقق من صحة الأدوية والتأكد من تطابقها مع الوصفة الطبية عبر الباركود.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-service">
                        <div class="service-icon"><i class="fas fa-user-md"></i></div>
                        <h4 class="service-title">استشارات طبية فورية</h4>
                        <p class="service-text">إمكانية التواصل مع الأطباء والصيادلة مباشرةً للحصول على استشارات طبية موثوقة.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
