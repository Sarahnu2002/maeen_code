@extends('website.app')

@section('content')
    <div id="services">
        <div class="container">
            <div class="row py-0 py-md-3 py-lg-5">
                <div class="col-12 text-center mt-3">
                    <h1 class="text-dark pb-4">خدماتنا</h1>
                    <div class="border-top border-dark mx-auto"></div>
                    <p data-aos="slide-up" data-aos-offset="200" data-aos-delay="100" class="lead pt-4 aos-init">
                        نقدم لكم حلولًا متكاملة وآمنة لإدارة الأدوية والوصفات الطبية، مما يساعد على تقليل الأخطاء الدوائية وتحسين تجربة المرضى.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row pl-4 py-0 py-md-3 py-lg-5">
                <!-- خدمة 1: الكشف عن أخطاء الأدوية -->
                <div data-aos="fade-right" class="col-lg-4 col-md-6 text-left aos-init">
                    <div class="card border border-light" style="width: 18rem">
                        <div class="card-body my-3 mx-2 text-center">
                            <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                            <h5 class="card-title">الكشف عن أخطاء الأدوية</h5>
                            <p class="card-text text-muted">
                                نظام ذكي يكتشف الأخطاء في الأسماء المتشابهة للأدوية لتقليل المخاطر وتحسين سلامة الوصفات الطبية.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- خدمة 2: تنبيهات التفاعلات الدوائية -->
                <div data-aos="fade-left" class="col-lg-4 col-md-6 text-left aos-init">
                    <div class="card border border-light" style="width: 18rem">
                        <div class="card-body my-2 mx-2 text-center">
                            <i class="fas fa-bell fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">تنبيهات التفاعلات الدوائية</h5>
                            <p class="card-text text-muted">
                                يتعرف النظام تلقائيًا على التفاعلات الخطيرة بين الأدوية، ويقوم بتنبيه المستخدمين لتجنب المشكلات الصحية.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- خدمة 3: التذكير بمواعيد الأدوية -->
                <div data-aos="fade-left" class="col-lg-4 col-md-6 text-left aos-init">
                    <div class="card border border-light" style="width: 18rem">
                        <div class="card-body my-1 mx-2 text-center">
                            <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">التذكير بمواعيد الأدوية</h5>
                            <p class="card-text text-muted">
                                احصل على تنبيهات ذكية لتناول الأدوية في الوقت المناسب وفقًا للوصفة الطبية، مما يساعد على تحسين الامتثال العلاجي.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- خدمة 4: فحص الأدوية عبر الباركود -->
                <div data-aos="fade-right" class="col-lg-4 col-md-6 text-left aos-init">
                    <div class="card border border-light mt-lg-5" style="width: 18rem">
                        <div class="card-body my-1 mx-2 text-center">
                            <i class="fas fa-barcode fa-3x text-dark mb-3"></i>
                            <h5 class="card-title">فحص الأدوية عبر الباركود</h5>
                            <p class="card-text text-muted">
                                امسح الباركود الخاص بالأدوية للتحقق من تطابقها مع الوصفة الطبية، مما يساعد على تجنب صرف أدوية خاطئة.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- خدمة 5: التواصل مع الأطباء والصيادلة -->
                <div data-aos="fade-right" class="col-lg-4 col-md-6 text-left aos-init">
                    <div class="card border border-light mt-lg-5" style="width: 18rem">
                        <div class="card-body my-3 mx-2 text-center">
                            <i class="fas fa-user-md fa-3x text-success mb-3"></i>
                            <h5 class="card-title">التواصل مع الأطباء والصيادلة</h5>
                            <p class="card-text text-muted">
                                إمكانية التواصل المباشر مع الأطباء والصيادلة للحصول على استشارات طبية موثوقة عبر التطبيق.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- خدمة 6: إدارة السجل الدوائي -->
                <div data-aos="fade-left" class="col-lg-4 col-md-6 text-left aos-init">
                    <div class="card border border-light mt-lg-5" style="width: 18rem">
                        <div class="card-body my-3 mx-2 text-center">
                            <i class="fas fa-file-medical fa-3x text-info mb-3"></i>
                            <h5 class="card-title">إدارة السجل الدوائي</h5>
                            <p class="card-text text-muted">
                                يوفر التطبيق سجلًا متكاملاً للوصفات الطبية السابقة، مما يسهل الوصول إلى تاريخ العلاج والأدوية المستخدمة.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row py-0 py-md-3 py-lg-5">
                <div class="col-12 text-center">
                    <a href="#" class="btn btn-primary">تعرف على المزيد</a>
                </div>
            </div>
        </div>
    </div>
@endsection
