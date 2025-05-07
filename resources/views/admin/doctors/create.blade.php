@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-plus"></i> {{ __('إضافة طبيب جديد') }}</h1>
        </div>

        <div class="tile">
            <form method="POST" action="{{ route('admin.doctors.store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>الاسم الأول</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                        @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>اسم العائلة</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
                        @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>كلمة المرور</label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>التخصص</label>
                        <input type="text" name="specialty" class="form-control" value="{{ old('specialty') }}">
                        @error('specialty') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success">{{ __('حفظ') }}</button>
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">{{ __('إلغاء') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
