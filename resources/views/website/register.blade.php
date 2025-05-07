@extends('website.app')

@section('content')
    <!-- Banner Section -->
    <section class="banner-area1 other-page mtop">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="{{ asset('assets/images/bg.png') }}" alt="مَعين" class="banner-image1 img-fluid">
                </div>
                <div class="col-lg-1 text-center d-none d-lg-block">
                    <div class="vertical-line"></div>
                </div>
                <div class="col-lg-6">
                    <h1 class="mb-3">التسجيل في معين</h1>
                    <p class="banner-text1 text-muted">
                        يمكنك اختيار أحد الأدوار الثلاثة: طبيب، صيدلي، أو مريض. كل دور يوفر لك تجربة مختلفة وخدمات متخصصة.

                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Options -->
    <div id="register" class="bg-light py-5 mb-5">
        <div class="container">


            <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                <!-- Doctor Card -->
                <div class="col">
                    <div class="card h-100 border-0 shadow text-center">
                        <div class="card-body">
                            <i class="fas fa-user-md fa-4x text-primary mb-3"></i>
                            <h5 class="card-title fw-bold">تسجيل الطبيب</h5>
                            <p class="card-text text-muted">
                                انضم إلينا كطبيب للوصول إلى لوحة التحكم الطبية، وإدارة الوصفات ومتابعة المرضى.
                            </p>
                            <a href="{{ route('register', ['type' => 'doctor']) }}" class="btn btn-primary">
                                تسجيل كطبيب
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pharmacist Card -->
                <div class="col">
                    <div class="card h-100 border-0 shadow text-center">
                        <div class="card-body">
                            <i class="fas fa-prescription-bottle-alt fa-4x text-primary mb-3"></i>
                            <h5 class="card-title fw-bold">تسجيل الصيدلي</h5>
                            <p class="card-text text-muted">
                                ابدأ رحلتك كصيدلي لإدارة الأدوية والوصفات وتقديم خدماتك بشكل أكثر فعالية.
                            </p>
                            <a href="{{ route('register', ['type' => 'pharmacist']) }}" class="btn btn-primary">
                                تسجيل كصيدلي
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Patient Card -->
                <div class="col">
                    <div class="card h-100 border-0 shadow text-center">
                        <div class="card-body">
                            <i class="fas fa-user fa-4x text-primary mb-3"></i>
                            <h5 class="card-title fw-bold">تسجيل المريض</h5>
                            <p class="card-text text-muted">
                                احصل على رعاية صحية أفضل عبر تتبع وصفاتك والتواصل المباشر مع الأطباء والصيادلة.
                            </p>
                            <a href="{{ route('register', ['type' => 'patient']) }}" class="btn btn-primary">
                                تسجيل كمريض
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#register -->
@endsection
