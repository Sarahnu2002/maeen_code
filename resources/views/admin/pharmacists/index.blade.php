@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title d-flex justify-content-between align-items-center">
            <h1><i class="fa fa-medkit"></i> {{ __('قائمة الصيادلة') }}</h1>
            <a href="{{ route('admin.pharmacists.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> {{ __('إضافة صيدلي') }}
            </a>
        </div>

        <div class="tile">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped table-bordered" id="sampleTable">
                <thead>
                <tr>
                    <th>{{ __('الاسم الكامل') }}</th>
                    <th>{{ __('البريد الإلكتروني') }}</th>
                    <th>{{ __('رقم الهاتف') }}</th>
                    <th>{{ __('اسم الصيدلية') }}</th>
                    <th>{{ __('الإجراءات') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pharmacists as $pharmacist)
                    <tr>
                        <td>{{ optional($pharmacist->user)->full_name }}</td>
                        <td>{{ optional($pharmacist->user)->email }}</td>
                        <td>{{ optional($pharmacist->user)->phone }}</td>
                        <td>{{ $pharmacist->pharmacy_name ?? 'غير معروف' }}</td>

                        <td>
                            <a href="{{ route('admin.pharmacists.edit', $pharmacist->pharmacist_id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pharmacists.destroy', $pharmacist->pharmacist_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pharmacists = @json($pharmacists);
            pharmacists.forEach(ph => {
                const qrEl = document.getElementById(`qrcode-${ph.id}`);
                if (qrEl) {
                    new QRCode(qrEl, {
                        text: ph.id.toString(),
                        width: 60,
                        height: 60
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
                link.download = `pharmacist_qr_${filename}.png`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    </script>
@endpush
