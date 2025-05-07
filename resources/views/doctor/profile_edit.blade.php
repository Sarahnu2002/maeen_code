@extends('admin.main')
{{-- Or use a 'doctor.main' layout if you separate the doctor from the admin layout --}}

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> {{ __('تحديث بيانات الطبيب') }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ __('تحديث ملف الطبيب') }}</h3>

                    {{-- Example: Form points to 'doctor.profile.update' with PUT method --}}
                    <form class="row" method="post" action="{{ route('doctor.profile.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- 1) Basic User Fields --}}
                        <div class="form-group col-md-6">
                            <label for="firstName">{{ __('الاسم الأول') }}</label>
                            <input class="form-control" id="firstName" type="text" name="first_name"
                                   value="{{ old('first_name', $user->first_name) }}" required>
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lastName">{{ __('الاسم الأخير') }}</label>
                            <input class="form-control" id="lastName" type="text" name="last_name"
                                   value="{{ old('last_name', $user->last_name) }}" required>
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone">{{ __('رقم الجوال') }}</label>
                            <input class="form-control" id="phone" type="text" name="phone"
                                   value="{{ old('phone', $user->phone) }}" required>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">{{ __('البريد الإلكتروني') }}</label>
                            <input class="form-control" id="email" type="email" name="email"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Optional: New Password --}}
                        <div class="form-group col-md-6">
                            <label for="password">{{ __('كلمة مرور جديدة') }}</label>
                            <input class="form-control" id="password" type="password" name="password" autocomplete="new-password">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password_confirmation">{{ __('تأكيد كلمة المرور') }}</label>
                            <input class="form-control" id="password_confirmation" type="password"
                                   name="password_confirmation" autocomplete="new-password">
                            @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 2) Doctor-Specific Fields --}}
                        <div class="form-group col-md-6">
                            <label for="specialization">{{ __('التخصص') }}</label>
                            <input class="form-control" id="specialization" type="text" name="specialization"
                                   value="{{ old('specialization', $doctor->specialization) }}" required>
                            @error('specialization')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="department">{{ __('القسم') }}</label>
                            <input class="form-control" id="department" type="text" name="department"
                                   value="{{ old('department', $doctor->department) }}">
                            @error('department')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="clinic_address">{{ __('عنوان العيادة') }}</label>
                            <input class="form-control" id="clinic_address" type="text" name="clinic_address"
                                   value="{{ old('clinic_address', $doctor->clinic_address) }}" required>
                            @error('clinic_address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="license_number">{{ __('رقم الترخيص') }}</label>
                            <input class="form-control" id="license_number" type="text" name="license_number"
                                   value="{{ old('license_number', $doctor->license_number) }}" required>
                            @error('license_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="work_hours">{{ __('ساعات العمل') }}</label>
                            <input class="form-control" id="work_hours" type="text" name="work_hours"
                                   value="{{ old('work_hours', $doctor->work_hours) }}" required>
                            @error('work_hours')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 3) Submit Button --}}
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('حفظ التعديلات') }} <i class="fa fa-save"></i>
                            </button>
                        </div>

                    </form> <!-- /form -->
                </div> <!-- /tile -->
            </div> <!-- /col-md-12 -->
        </div> <!-- /row -->
    </main>
@endsection
