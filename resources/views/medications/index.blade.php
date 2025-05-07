{{-- resources/views/medications/index.blade.php --}}
@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1>
                <i class="fa fa-calendar"></i> {{ __('إدارة الأدوية') }}
            </h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    {{-- Title + "Add Medication" + "Scan QR" --}}
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('قائمة الأدوية') }}</h3>
                        @if(auth()->user()->doctor || auth()->user()->pharmacist)
                            <div class="ml-auto">
                                <!-- Button: Scan QR Code -->
                                <button class="btn btn-secondary" id="scanQrBtn">
                                    <i class="fa fa-qrcode"></i>
                                    {{ __('مسح الباركود') }}
                                </button>

                                <!-- Button: Add Medication -->
                                <a href="{{ route('medications.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> {{ __('إضافة دواء') }}
                                </a>
                            </div>
                        @endif


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

                    <!-- Table of medications -->
                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>{{ __('رقم') }}</th>
                            <th>{{ __('اسم الدواء') }}</th>
                            <th>{{ __('العيار') }}</th>
                            <th>{{ __('الشكل') }}</th>
                            <th>{{ __('الشركة المصنعة') }}</th>
                            <th>{{ __('رمز QR') }}</th>

                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($medications as $medication)
                            <tr>
                                <td>{{ $medication->medication_id }}</td>
                                <td>{{ $medication->name }}</td>
                                <td>{{ $medication->strength }}</td>
                                <td>{{ $medication->dosage_form }}</td>
                                <td>{{ $medication->manufacturer }}</td>
                                <td>
                                    <div id="qrcode-{{ $medication->medication_id }}"></div>
                                    <button class="btn btn-sm btn-outline-primary w-100 mt-1" onclick="downloadQr('qrcode-{{ $medication->medication_id }}', '{{ $medication->medication_id }}')">
                                        <i class="fa fa-download"></i> {{ __('تنزيل') }}
                                    </button>
                                </td>

                                <td>
                                    @if(auth()->user()->doctor || auth()->user()->pharmacist)
                                        <a href="{{ route('medications.edit', $medication->medication_id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('medications.destroy', $medication->medication_id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('{{ __('هل أنت متأكد؟') }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- If you want a show button, etc. --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- If you have pagination -->
                    {{-- {{ $medications->links() }} --}}
                </div>
            </div>
        </div>

        <!-- Hidden area for the QR scanner UI -->
        <div id="qrReaderModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fa fa-qrcode"></i> {{ __('مسح الباركود') }}
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Container for html5-qrcode -->
                        <div id="qr-reader" style="width: 100%;"></div>
                        <div id="qr-reader-results" class="mt-3"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('إغلاق') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const meds = @json($medications);
                meds.forEach(med => {
                    const qrContainer = document.getElementById(`qrcode-${med.medication_id}`);
                    if (qrContainer) {
                        new QRCode(qrContainer, {
                            text: med.medication_id.toString(),
                            width: 50,
                            height: 50,
                        });
                    }
                });
            });

            function downloadQr(containerId, filename) {
                const canvas = document.querySelector(`#${containerId} canvas`);
                if (canvas) {
                    const url = canvas.toDataURL("image/png");
                    const link = document.createElement("a");
                    link.href = url;
                    link.download = `medication_qr_${filename}.png`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }


            let qrScannerInstance;

            document.getElementById('scanQrBtn').addEventListener('click', function () {
                $('#qrReaderModal').modal('show');

                if (!qrScannerInstance) {
                    qrScannerInstance = new Html5Qrcode("qr-reader");
                    qrScannerInstance.start(
                        { facingMode: "environment" },
                        { fps: 10, qrbox: 250 },
                        (decodedText, decodedResult) => {
                            document.getElementById('qr-reader-results').innerHTML =
                                `<div class="alert alert-success">تم المسح: ${decodedText}</div>`;

                            // Automatically redirect to edit medication page
                            window.location.href = `/admin/medications/${decodedText}/edit`;
                        },
                        (errorMessage) => {
                            // silently ignore scan failures
                        }
                    );
                }
            });

            // Stop scanner when modal is closed
            $('#qrReaderModal').on('hidden.bs.modal', function () {
                if (qrScannerInstance) {
                    qrScannerInstance.stop().then(() => {
                        qrScannerInstance.clear();
                        qrScannerInstance = null;
                        document.getElementById('qr-reader-results').innerHTML = '';
                    });
                }
            });

        </script>
    @endpush

