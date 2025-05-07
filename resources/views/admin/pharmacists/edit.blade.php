@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-edit"></i> {{ __('تعديل بيانات الصيدلي') }}</h1>
        </div>

        <div class="tile">
            <form method="POST" action="{{ route('admin.pharmacists.update', $pharmacist->pharmacist_id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>الاسم الأول</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $pharmacist->user->first_name) }}">
                        @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>اسم العائلة</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $pharmacist->user->last_name) }}">
                        @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $pharmacist->user->email) }}">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $pharmacist->user->phone) }}">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>كلمة المرور (اختياري)</label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>اسم الصيدلية</label>
                        <input type="text" name="pharmacy_name" class="form-control" value="{{ old('pharmacy_name', $pharmacist->pharmacy_name) }}">
                        @error('pharmacy_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary">{{ __('تحديث') }}</button>
                        <a href="{{ route('admin.pharmacists.index') }}" class="btn btn-secondary">{{ __('رجوع') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
