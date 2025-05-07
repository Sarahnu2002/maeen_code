
@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>
                    <i class="fa fa-dashboard"></i> {{ __('لوحة تحكم الطبيب') }}
                </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <i class="fa fa-home fa-lg"></i>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">{{ __('الرئيسية') }}</a>
                </li>
            </ul>
        </div>

        <!-- Stats Widgets Row -->
        <div class="row">
            <!-- Count of Prescriptions -->
            <div class="col-md-6 col-lg-4">
                <div  class="widget-small primary coloured-icon">
                    <i  style="background:red;" class="icon fa fa-file-text fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الوصفات') }}</h4>
                        <p><b>{{ $prescriptionCount }}</b></p>
                    </div>
                </div>
            </div>

            <!-- Count of Medications -->
            <div class="col-md-6 col-lg-4">
                <div class="widget-small info coloured-icon">
                    <i class="icon fa fa-medkit fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الأدوية') }}</h4>
                        <p><b>{{ $medicationCount }}</b></p>
                    </div>
                </div>
            </div>

            <!-- Count of Consultations (static 12 for now) -->
            <div class="col-md-6 col-lg-4">
                <div class="widget-small warning coloured-icon">
                    <i class="icon fa fa-comments fa-3x"></i>
                    <div class="info">
                        <h4>{{ __('الاستشارات') }}</h4>
                        <p><b>{{ $consultationCount }}</b></p>
                    </div>
                </div>
            </div>
        </div> <!-- /row -->

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ __('مخطط الوصفات الشهرية') }}</h3>
                    <div id="prescriptionChart"></div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('chart')
    <!-- Include ApexCharts from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: '{{ __("عدد الوصفات") }}',
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
                        text: '{{ __("العدد") }}'
                    },
                    min: 0
                },
                title: {
                    text: '{{ __("الوصفات الشهرية") }}',
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

            var chart = new ApexCharts(document.querySelector("#prescriptionChart"), options);
            chart.render();
        });
    </script>
@endpush
