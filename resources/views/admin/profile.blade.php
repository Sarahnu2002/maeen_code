@extends('admin.main')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-user"></i> {{ __('تحديث بيانات المشرف') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
        <form method="post" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="form-group col-md-6">
                    <label>{{ __('اسم المستخدم') }}</label>
                    <input type="text" name="username" value="{{ old('username', $admin->username) }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('البريد الإلكتروني') }}</label>
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('رقم الجوال') }}</label>
                    <input type="text" name="phone" value="{{ old('phone', $admin->phone) }}" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('الدور الإداري') }}</label>
                    <select name="role" class="form-control" required>
                        <option value="Super Admin" {{ $admin->role == 'Super Admin' ? 'selected' : '' }}>{{ __('مدير عام') }}</option>
                        <option value="Admin" {{ $admin->role == 'Admin' ? 'selected' : '' }}>{{ __('مشرف') }}</option>
                    </select>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>{{ __('كلمة المرور الجديدة') }}</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('تأكيد كلمة المرور') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ __('حفظ التعديلات') }}</button>
        </form>
                </div>
                </div>
                </div>
    </main>

@endsection
