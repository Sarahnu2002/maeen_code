@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> {{ __('لوحة تحكم الصيدلي') }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="widget-small primary coloured-icon">
                    <i class="icon fa fa-pencil-square fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الوصفات') }}</h4>
                        <p><b>{{ $prescriptionCount }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget-small info coloured-icon">
                    <i class="icon fa fa-medkit fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الأدوية') }}</h4>
                        <p><b>{{ $medicationCount }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget-small warning coloured-icon">
                    <i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('المرضى') }}</h4>
                        <p><b>{{ $patientCount }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
