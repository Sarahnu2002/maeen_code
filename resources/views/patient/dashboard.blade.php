@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-dashboard"></i> {{ __('لوحة تحكم المريض') }}</h1>
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
                    <i class="icon fa fa-user-md fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الأطباء') }}</h4>
                        <p><b>{{ $doctorCount }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget-small warning coloured-icon">
                    <i class="icon fa fa-medkit fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الصيادلة') }}</h4>
                        <p><b>{{ $pharmacistCount }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
