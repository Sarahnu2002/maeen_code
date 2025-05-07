@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-user"></i> {{ __('قائمة الصيادلة') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ __('جميع الصيادلة المسجلين') }}</h3>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{ __('الاسم الكامل') }}</th>
                                <th>{{ __('البريد الإلكتروني') }}</th>
                                <th>{{ __('رقم الهاتف') }}</th>
                                <th>{{ __('اسم الصيدلية') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pharmacists as $pharmacist)
                                <tr>
                                    <td>{{ optional($pharmacist->user)->full_name }}</td>
                                    <td>{{ optional($pharmacist->user)->email }}</td>
                                    <td>{{ optional($pharmacist->user)->phone }}</td>
                                    <td>{{ $pharmacist->pharmacy_name ?? __('غير معروف') }}</td>
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
