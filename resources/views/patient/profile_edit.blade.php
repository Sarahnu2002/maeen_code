@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-edit"></i> {{ __('تحديث بيانات المريض') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
        <form method="post" action="{{ route('patient.profile.update') }}">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>{{ __('الاسم الأول') }}</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('الاسم الأخير') }}</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('اسم المستخدم') }}</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('البريد الإلكتروني') }}</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('رقم الجوال') }}</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('الحالة') }}</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>{{ __('نشط') }}</option>
                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>{{ __('غير نشط') }}</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>{{ __('كلمة المرور الجديدة') }}</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('تأكيد كلمة المرور') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>{{ __('العنوان') }}</label>
                    <input type="text" name="address" value="{{ old('address', $patient->address) }}" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('تاريخ الميلاد') }}</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth) }}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('التأمين الصحي') }}</label>
                    <input type="text" name="insurance_info" value="{{ old('insurance_info', $patient->insurance_info) }}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('الحساسية') }}</label>
                    <input type="text" name="allergies" value="{{ old('allergies', $patient->allergies) }}" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label>{{ __('التاريخ الطبي') }}</label>
                    <textarea name="medical_history" class="form-control" rows="3">{{ old('medical_history', $patient->medical_history) }}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <label>{{ __('جهة الاتصال في حالة الطوارئ') }}</label>
                    <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $patient->emergency_contact) }}" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ __('حفظ التعديلات') }}</button>
        </form>
                </div>
            </div>
        </div>
    </main>
@endsection
