@extends('website.app')

@section('content')
    <div id="login" class="bg-light py-5">
        <div class="container">
            <!-- العنوان الرئيسي -->
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="text-dark fw-bold pb-3">تسجيل الدخول</h1>
                    <p class="lead text-muted w-75 mx-auto">
                        اختر نوع حسابك لتسجيل الدخول بسهولة والوصول إلى خدمات معين.
                    </p>
                </div>
            </div>

            <!-- خيارات تسجيل الدخول -->
            <div class="row mt-5 text-center">
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-lg rounded">
                        <i class="fas fa-user-md fa-4x text-primary mb-3"></i>
                        <h4 class="text-dark fw-bold">تسجيل دخول الطبيب</h4>
                        <a href="{{ route('login', ['type' => 'doctor']) }}" class="btn btn-primary">دخول كطبيب</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-lg rounded">
                        <i class="fas fa-prescription-bottle-alt fa-4x text-danger mb-3"></i>
                        <h4 class="text-dark fw-bold">تسجيل دخول الصيدلي</h4>
                        <a href="{{ route('login', ['type' => 'pharmacist']) }}" class="btn btn-danger">دخول كصيدلي</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-lg rounded">
                        <i class="fas fa-user fa-4x text-success mb-3"></i>
                        <h4 class="text-dark fw-bold">تسجيل دخول المريض</h4>
                        <a href="{{ route('login', ['type' => 'patient']) }}" class="btn btn-success">دخول كمريض</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
