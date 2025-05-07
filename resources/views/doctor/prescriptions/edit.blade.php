@extends('admin.main')
@section('content')

        <main class="app-content">
            <div class="app-title">
                <h1><i class="fa fa-plus-circle"></i>تعديل الوصفة رقم #{{ $prescription->prescription_id }}</h1>
            </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
        <form action="{{ route('doctor.prescriptions.update', $prescription->prescription_id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('doctor.prescriptions.form', [
                'prescription' => $prescription,
                'patients' => $patients,
                'pharmacies' => $pharmacies
            ])

            <button type="submit" class="btn btn-primary mt-3">
                تحديث
            </button>
        </form>
                    </div>
                </div>
            </div>
    </main>
@endsection
