@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-calendar"></i> {{ __('إدارة الوصفات') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('قائمة الوصفات') }}</h3>
                        <a href="{{ route('doctor.prescriptions.create') }}" class="btn btn-primary ml-auto">
                            <i class="fa fa-plus"></i> {{ __('إضافة وصفة') }}
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->has('error'))
                        <div class="alert alert-danger mt-2">
                            {{ $errors->first('error') }}
                        </div>
                    @endif

                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>{{ __('رقم') }}</th>
                            <th>{{ __('اسم المريض') }}</th>
                            <th>{{ __('تاريخ الإصدار') }}</th>
                            <th>{{ __('الحالة') }}</th>
                            <th>{{ __('الجرعة') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($prescriptions as $prescription)
                            <tr>
                                <td>{{ $prescription->prescription_id }}</td>
                                <td>
                                    @if($prescription->patient && $prescription->patient->user)
                                        {{ $prescription->patient->user->first_name }}
                                        {{ $prescription->patient->user->last_name }}
                                    @else
                                        <span class="text-muted">{{ __('غير معروف') }}</span>
                                    @endif
                                </td>
                                <td>{{ $prescription->date_issued }}</td>
                                <td>{{ $prescription->status }}</td>
                                <td>{{ $prescription->dosage }}</td>
                                <td>
                                    <!-- Edit & Delete Buttons -->
                                    <a href="{{ route('doctor.prescriptions.edit', $prescription->prescription_id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('doctor.prescriptions.destroy', $prescription->prescription_id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('{{ __('هل أنت متأكد؟') }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    <!-- 'عرض الروشته' Button to open Modal -->
                                    <button type="button"
                                            class="btn btn-secondary btn-sm"
                                            data-toggle="modal"
                                            data-target="#prescriptionModal{{ $prescription->prescription_id }}">
                                        {{ __('عرض الروشته') }}
                                        <i class="fa fa-file"></i>
                                    </button>

                                    <!-- Modal for viewing the Prescription -->
                                    <div class="modal fade"
                                         id="prescriptionModal{{ $prescription->prescription_id }}"
                                         tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="prescriptionModalLabel{{ $prescription->prescription_id }}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">

                                                {{-- Modal Header --}}
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="prescriptionModalLabel{{ $prescription->prescription_id }}">
                                                        {{ __('الروشتة') }} #{{ $prescription->prescription_id }}
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                {{-- Modal Body --}}
                                                <div class="modal-body">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <!-- Row 1: Doctor / Pharmacy -->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('اسم الطبيب:') }}</strong>
                                                                    <br>
                                                                    @if($prescription->doctor && $prescription->doctor->user)
                                                                        {{ $prescription->doctor->user->first_name }}
                                                                        {{ $prescription->doctor->user->last_name }}
                                                                    @else
                                                                        <span class="text-muted">{{ __('غير معروف') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('اسم الصيدلية:') }}</strong>
                                                                    <br>
                                                                    @if($prescription->pharmacy)
                                                                        {{ $prescription->pharmacy->pharmacy_name }}
                                                                    @else
                                                                        <span class="text-muted">{{ __('غير معروفة') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <!-- Row 2: Patient / Date Issued -->
                                                            <div class="row mt-3">
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('اسم المريض:') }}</strong>
                                                                    <br>
                                                                    @if($prescription->patient && $prescription->patient->user)
                                                                        {{ $prescription->patient->user->first_name }}
                                                                        {{ $prescription->patient->user->last_name }}
                                                                    @else
                                                                        <span class="text-muted">{{ __('غير معروف') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('تاريخ الإصدار:') }}</strong>
                                                                    <br>
                                                                    {{ $prescription->date_issued }}
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <!-- Row 3: Status / Dosage -->
                                                            <div class="row mt-3">
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('الحالة:') }}</strong>
                                                                    <br>
                                                                    {{ $prescription->status ?? __('غير محدد') }}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>{{ __('الجرعة:') }}</strong>
                                                                    <br>
                                                                    {{ $prescription->dosage ?? __('غير محدد') }}
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <!-- Instructions -->
                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <strong>{{ __('التعليمات:') }}</strong>
                                                                    <p class="mt-1 mb-0">
                                                                        {{ $prescription->instructions ?? __('لا توجد تعليمات') }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <!-- Medications Table -->
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
                                                        </div> <!-- card-body -->
                                                    </div> <!-- card -->
                                                </div> <!-- modal-body -->

                                                {{-- Modal Footer --}}
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
