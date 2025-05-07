@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-users"></i> {{ __('قائمة المرضى') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ __('جميع المرضى المسجلين') }}</h3>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{ __('الاسم الكامل') }}</th>
                                <th>{{ __('البريد الإلكتروني') }}</th>
                                <th>{{ __('رقم الهاتف') }}</th>
                                <th>{{ __('رقم الهوية') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ optional($patient->user)->full_name }}</td>
                                    <td>{{ optional($patient->user)->email }}</td>
                                    <td>{{ optional($patient->user)->phone }}</td>
                                    <td>{{ $patient->national_id ?? __('غير متوفر') }}</td>
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
