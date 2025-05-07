@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title d-flex justify-content-between align-items-center">
            <h1><i class="fa fa-user-md"></i> {{ __('قائمة الأطباء') }}</h1>
            <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> {{ __('إضافة طبيب') }}
            </a>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ __('جميع الأطباء المسجلين') }}</h3>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{ __('الاسم الكامل') }}</th>
                                <th>{{ __('البريد الإلكتروني') }}</th>
                                <th>{{ __('رقم الهاتف') }}</th>
                                <th>{{ __('التخصص') }}</th>
                                <th>{{ __('الإجراءات') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($doctors as $doctor)
                                <tr>
                                    <td>{{ optional($doctor->user)->full_name }}</td>
                                    <td>{{ optional($doctor->user)->email }}</td>
                                    <td>{{ optional($doctor->user)->phone }}</td>
                                    <td>{{ $doctor->specialty ?? __('غير محدد') }}</td>
                                    <td>
                                        <a href="{{ route('admin.doctors.edit', $doctor->doctor_id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.doctors.destroy', $doctor->doctor_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
