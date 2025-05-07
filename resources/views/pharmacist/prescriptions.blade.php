@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-calendar"></i> {{ __('أرشيف الوصفات الطبية') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{ __('قائمة الوصفات الطبية') }}</h3>

                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>{{ __('رقم الوصفة') }}</th>
                            <th>{{ __('تاريخ الإصدار') }}</th>
                            <th>{{ __('المريض ') }}</th>
                            <th>{{ __('الطبيب المعالج') }}</th>
                            <th>{{ __('الحالة') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($prescriptions as $prescription)
                            <tr>
                                <td>{{ $prescription->prescription_id }}</td>
                                <td>{{ $prescription->date_issued }}</td>
                                <td>{{ optional($prescription->patient->user)->full_name }}</td>
                                <td>
                                    @if($prescription->doctor && $prescription->doctor->user)
                                        {{ $prescription->doctor->user->first_name }} {{ $prescription->doctor->user->last_name }}
                                    @else
                                        <span class="text-muted">{{ __('غير معروف') }}</span>
                                    @endif
                                </td>
                                @php
                                    $dispense = \App\Models\PrescriptionDispense::where('prescription_id', $prescription->prescription_id)->first();
                                @endphp
                                <td>
                                    @if($dispense)
                                        <span class="badge badge-success">تم الصرف</span>
                                    @else
                                        <span class="badge badge-warning">غير مصروفة</span>
                                    @endif
                                </td>

                                <td>
                                    <!-- زر صرف يفتح مودال جديد -->
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dispenseModal{{ $prescription->prescription_id }}">
                                        صرف <i class="fa fa-check"></i>
                                    </button>

                                    <!-- Modal صرف الروشتة -->
                                    <div class="modal fade" id="dispenseModal{{ $prescription->prescription_id }}" tabindex="-1" role="dialog" aria-labelledby="dispenseModalLabel{{ $prescription->prescription_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form action="{{ route('pharmacist.prescriptions.dispense', $prescription->prescription_id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title">صرف الوصفة الطبية #{{ $prescription->prescription_id }}</h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="إغلاق">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p><strong>تأكيد صرف هذه الوصفة؟</strong></p>

                                                        <hr>
                                                        <p><strong>المريض:</strong> {{ optional($prescription->patient->user)->full_name ?? 'غير معروف' }}</p>
                                                        <p><strong>الطبيب:</strong>
                                                            @if($prescription->doctor && $prescription->doctor->user)
                                                                {{ $prescription->doctor->user->first_name }} {{ $prescription->doctor->user->last_name }}
                                                            @else
                                                                <span class="text-muted">غير معروف</span>
                                                            @endif
                                                        </p>
                                                        <p><strong>تاريخ الإصدار:</strong> {{ $prescription->date_issued }}</p>

                                                        @if($prescription->medications && $prescription->medications->count() > 0)
                                                            <div class="table-responsive mt-2">
                                                                <table class="table table-bordered table-sm">
                                                                    <thead class="thead-light">
                                                                    <tr>
                                                                        <th>اسم الدواء</th>
                                                                        <th>العيار</th>
                                                                        <th>الشكل الصيدلاني</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($prescription->medications as $med)
                                                                        <tr>
                                                                            <td>{{ $med->name }}</td>
                                                                            <td>{{ $med->strength }}</td>
                                                                            <td>{{ $med->dosage_form }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">تأكيد الصرف</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <!-- 'عرض الروشتة' Button to open Modal -->
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#prescriptionModal{{ $prescription->prescription_id }}">
                                        {{ __('عرض الروشتة') }} <i class="fa fa-file"></i>
                                    </button>

                                    <!-- Modal for viewing the Prescription -->
                                    <div class="modal fade" id="prescriptionModal{{ $prescription->prescription_id }}" tabindex="-1" role="dialog" aria-labelledby="prescriptionModalLabel{{ $prescription->prescription_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">{{ __('الروشتة') }} #{{ $prescription->prescription_id }}</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('الطبيب المعالج:') }}</strong>
                                                                    <br>
                                                                    @if($prescription->doctor && $prescription->doctor->user)
                                                                        {{ $prescription->doctor->user->first_name }} {{ $prescription->doctor->user->last_name }}
                                                                    @else
                                                                        <span class="text-muted">{{ __('غير معروف') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('الصيدلية:') }}</strong>
                                                                    <br>
                                                                    @if($prescription->pharmacy)
                                                                        {{ $prescription->pharmacy->pharmacy_name }}
                                                                    @else
                                                                        <span class="text-muted">{{ __('غير معروفة') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="row mt-3">
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('تاريخ الإصدار:') }}</strong>
                                                                    <br>
                                                                    {{ $prescription->date_issued }}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('الحالة:') }}</strong>
                                                                    <br>
                                                                    {{ $prescription->status }}
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <strong>{{ __('التعليمات:') }}</strong>
                                                                    <p class="mt-1 mb-0">{{ $prescription->instructions ?? __('لا توجد تعليمات') }}</p>
                                                                </div>
                                                            </div>

                                                            @if($prescription->medications && $prescription->medications->count() > 0)
                                                                <hr>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-12">
                                                                        <strong>{{ __('الأدوية الموصوفة:') }}</strong>
                                                                        <div class="table-responsive mt-2">
                                                                            <table class="table table-bordered table-sm">
                                                                                <thead class="thead-light">
                                                                                <tr>
                                                                                    <th>{{ __('اسم الدواء') }}</th>
                                                                                    <th>{{ __('العيار') }}</th>
                                                                                    <th>{{ __('الشكل الصيدلاني') }}</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @foreach($prescription->medications as $med)
                                                                                    <tr>
                                                                                        <td>{{ $med->name }}</td>
                                                                                        <td>{{ $med->strength }}</td>
                                                                                        <td>{{ $med->dosage_form }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        {{ __('إغلاق') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>
@endsection
