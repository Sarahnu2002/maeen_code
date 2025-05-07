@extends('admin.main')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> {{ __('تحديث بيانات الصيدلي') }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ __('تحديث ملف الصيدلي') }}</h3>

                    <form class="row" method="post" action="{{ route('pharmacist.profile.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- 1) بيانات المستخدم الأساسية --}}
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

                        {{-- كلمة المرور اختيارية --}}
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

                        {{-- 2) بيانات الصيدلي --}}
                        <div class="form-group col-md-6">
                            <label for="shift_timings">{{ __('مواعيد العمل') }}</label>
                            <input class="form-control" id="shift_timings" type="text" name="shift_timings"
                                   value="{{ old('shift_timings', $pharmacist->shift_timings) }}" required>
                            @error('shift_timings')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="qualification">{{ __('المؤهل العلمي') }}</label>
                            <input class="form-control" id="qualification" type="text" name="qualification"
                                   value="{{ old('qualification', $pharmacist->qualification) }}" required>
                            @error('qualification')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="employee_number">{{ __('رقم الموظف') }}</label>
                            <input class="form-control" id="employee_number" type="text" name="employee_number"
                                   value="{{ old('employee_number', $pharmacist->employee_number) }}" required>
                            @error('employee_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 3) زر الحفظ --}}
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('حفظ التعديلات') }} <i class="fa fa-save"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection
