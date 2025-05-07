@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title d-flex justify-content-between align-items-center">
            <h1><i class="fa fa-users"></i> {{ __('قائمة المرضى') }}</h1>
            <a href="{{ route('admin.patients.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> {{ __('إضافة مريض') }}
            </a>
        </div>

        <div class="tile">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped table-bordered" id="sampleTable">
                <thead>
                <tr>
                    <th>{{ __('الاسم الكامل') }}</th>
                    <th>{{ __('البريد الإلكتروني') }}</th>
                    <th>{{ __('رقم الهاتف') }}</th>
                    <th>{{ __('الرقم الوطني') }}</th>
                    <th>{{ __('الإجراءات') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <td>{{ optional($patient->user)->full_name }}</td>
                        <td>{{ optional($patient->user)->email }}</td>
                        <td>{{ optional($patient->user)->phone }}</td>
                        <td>{{ $patient->national_id ?? 'غير متوفر' }}</td>

                        <td>
                            <a href="{{ route('admin.patients.edit', $patient->patient_id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.patients.destroy', $patient->patient_id) }}" method="POST" class="d-inline">
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
    </main>
@endsection

@push('js')

@endpush
