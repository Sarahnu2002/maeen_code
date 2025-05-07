@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-dashboard"></i> {{ __('لوحة تحكم المشرف') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="widget-small primary coloured-icon">
                    <i class="icon fa fa-user-md fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الأطباء') }}</h4>
                        <p><b>{{ $doctorCount }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget-small info coloured-icon">
                    <i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('المرضى') }}</h4>
                        <p><b>{{ $patientCount }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget-small warning coloured-icon">
                    <i class="icon fa fa-user-md fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الصيادلة') }}</h4>
                        <p><b>{{ $pharmacistCount }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget-small danger coloured-icon">
                    <i class="icon fa fa-pencil-square fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الوصفات الطبية') }}</h4>
                        <p><b>{{ $prescriptionCount }}</b></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ __('التقارير الشهرية') }}</h3>
                    <div id="adminChart"></div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: '{{ __(" احصائيات الوصفات الطبية") }}',
                    data: @json($chartValues)
                }],
                xaxis: {
                    categories: @json($chartLabels),
                    title: {
                        text: '{{ __("الشهر") }}'
                    }
                },
                yaxis: {
                    title: {
                        text: '{{ __("عدد العمليات") }}'
                    },
                    min: 0
                },
                title: {
                    text: '{{ __("الإحصائيات الشهرية") }}',
                    align: 'center'
                },
                stroke: {
                    width: 3
                },
                markers: {
                    size: 4
                },
                toolbar: {
                    show: false
                }
            }

            var chart = new ApexCharts(document.querySelector("#adminChart"), options);
            chart.render();
        });
    </script>
@endpush
