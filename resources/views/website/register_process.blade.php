@extends('website.app')

@section('content')
    @php
        // Map registration type to a readable Arabic label
        $typeLabels = [
            'doctor'     => 'طبيب',
            'pharmacist' => 'صيدلي',
            'patient'    => 'مريض',
        ];
        // Default to 'مريض' if not recognized
        $displayType = $typeLabels[$type] ?? 'مريض';
    @endphp

        <!-- Banner -->
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
                    <h1>التسجيل ك{{ $displayType }}</h1>
                    <p class="banner-text1">
                        اختر نوع حسابك وقم بالتسجيل للاستفادة من جميع خدماتنا.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Registration Form Box -->
    <div id="register" class="bg-light py-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="p-4 p-md-5 bg-white shadow-sm rounded">
                        <h2 class="text-center mb-4">نموذج التسجيل</h2>
                        @if($errors->has('error'))
                            <div class="alert alert-danger text-center">
                                {{ $errors->first('error') }}
                            </div>
                        @endif
                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf

                            <!-- Pass the type along as hidden -->
                            <input type="hidden" name="type" value="{{ $type }}">

                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">
                                        الاسم الأول <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="first_name"
                                        id="first_name"
                                        class="form-control"
                                        value="{{ old('first_name') }}"
                                        required
                                    >
                                    @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">
                                        اسم العائلة <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="last_name"
                                        id="last_name"
                                        class="form-control"
                                        value="{{ old('last_name') }}"
                                        required
                                    >
                                    @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> <!-- row -->

                            <div class="row">
                                <!-- Username -->
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">
                                        اسم المستخدم <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="username"
                                        id="username"
                                        class="form-control"
                                        value="{{ old('username') }}"
                                        required
                                    >
                                    @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        البريد الإلكتروني <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        value="{{ old('email') }}"
                                        required
                                    >
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> <!-- row -->

                            <div class="row">
                                <!-- Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">
                                        رقم الجوال <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="phone"
                                        id="phone"
                                        class="form-control"
                                        value="{{ old('phone') }}"
                                        required
                                    >
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        يجب أن يبدأ بـ <strong>05</strong> أو <strong>9665</strong> متبوعاً بثمانية أرقام
                                    </small>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">
                                        كلمة المرور <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        required
                                    >
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        يجب أن تكون 8 أحرف على الأقل، تشمل حرف كبير وحرف صغير ورقم
                                    </small>
                                </div>
                            </div> <!-- row -->

                            <!-- Password Confirmation -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    تأكيد كلمة المرور <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control"
                                    required
                                >
                            </div>

                            {{-- Doctor Fields --}}
                            @if($type === 'doctor')
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="specialization" class="form-label">
                                            التخصص <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            name="specialization"
                                            id="specialization"
                                            class="form-control"
                                            value="{{ old('specialization') }}"
                                            required
                                        >
                                        @error('specialization')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="form-label">
                                            القسم
                                        </label>
                                        <input
                                            type="text"
                                            name="department"
                                            id="department"
                                            class="form-control"
                                            value="{{ old('department') }}"
                                        >
                                        @error('department')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> <!-- row -->

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="clinic_address" class="form-label">
                                            عنوان العيادة <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            name="clinic_address"
                                            id="clinic_address"
                                            class="form-control"
                                            value="{{ old('clinic_address') }}"
                                            required
                                        >
                                        @error('clinic_address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="license_number" class="form-label">
                                            رقم الترخيص <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            name="license_number"
                                            id="license_number"
                                            class="form-control"
                                            value="{{ old('license_number') }}"
                                            required
                                        >
                                        @error('license_number')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> <!-- row -->

                                <div class="mb-3">
                                    <label for="work_hours" class="form-label">
                                        ساعات العمل <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="work_hours"
                                        id="work_hours"
                                        class="form-control"
                                        value="{{ old('work_hours') }}"
                                        required
                                    >
                                    @error('work_hours')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            {{-- Pharmacist Fields --}}
                            @if($type === 'pharmacist')
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="shift_timings" class="form-label">
                                            مواعيد الدوام <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            name="shift_timings"
                                            id="shift_timings"
                                            class="form-control"
                                            value="{{ old('shift_timings') }}"
                                            required
                                        >
                                        @error('shift_timings')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="qualification" class="form-label">
                                            المؤهل <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            name="qualification"
                                            id="qualification"
                                            class="form-control"
                                            value="{{ old('qualification') }}"
                                            required
                                        >
                                        @error('qualification')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> <!-- row -->

                                <div class="mb-3">
                                    <label for="employee_number" class="form-label">
                                        رقم الموظف <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="employee_number"
                                        id="employee_number"
                                        class="form-control"
                                        value="{{ old('employee_number') }}"
                                        required
                                    >
                                    @error('employee_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            {{-- Patient Fields --}}
                            @if($type === 'patient')
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">
                                            العنوان <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            name="address"
                                            id="address"
                                            class="form-control"
                                            value="{{ old('address') }}"
                                            required
                                        >
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="date_of_birth" class="form-label">
                                            تاريخ الميلاد <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="date"
                                            name="date_of_birth"
                                            id="date_of_birth"
                                            class="form-control"
                                            value="{{ old('date_of_birth') }}"
                                            required
                                        >
                                        @error('date_of_birth')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> <!-- row -->

                                <div class="mb-3">
                                    <label for="medical_history" class="form-label">
                                        التاريخ الطبي
                                    </label>
                                    <textarea
                                        name="medical_history"
                                        id="medical_history"
                                        class="form-control"
                                    >{{ old('medical_history') }}</textarea>
                                    @error('medical_history')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="allergies" class="form-label">
                                            الحساسية
                                        </label>
                                        <input
                                            type="text"
                                            name="allergies"
                                            id="allergies"
                                            class="form-control"
                                            value="{{ old('allergies') }}"
                                        >
                                        @error('allergies')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="insurance_info" class="form-label">
                                            معلومات التأمين
                                        </label>
                                        <input
                                            type="text"
                                            name="insurance_info"
                                            id="insurance_info"
                                            class="form-control"
                                            value="{{ old('insurance_info') }}"
                                        >
                                        @error('insurance_info')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> <!-- row -->

                                <div class="mb-3">
                                    <label for="emergency_contact" class="form-label">
                                        رقم الطوارئ
                                    </label>
                                    <input
                                        type="text"
                                        name="emergency_contact"
                                        id="emergency_contact"
                                        class="form-control"
                                        value="{{ old('emergency_contact') }}"
                                    >
                                    @error('emergency_contact')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-5">
                                    تسجيل
                                </button>
                            </div>
                        </form> <!-- /form -->

                    </div> <!-- /box -->
                </div> <!-- /col -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </div> <!-- /#register -->
@endsection
