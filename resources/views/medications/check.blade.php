@extends('admin.main')

@section('content')
        <main class="app-content">
            <div class="app-title">
                <h1>
                    <i class="fa fa-plus-circle"></i>
                    فحص التفاعلات الدوائية
                </h1>
            </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong></strong> اختر دواءين أو أكثر من القائمة، وسيقوم النظام بفحص التداخلات الدوائية المعروفة بينهم وعرضها مباشرةً.
        </div>
        <div class="card-body">
            <form action="{{ route('medications_check') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>اختر الأدوية</label>
                    <select name="medication_ids[]" class="form-control select2" multiple required>
                        @foreach($medications as $med)
                            <option value="{{ $med->medication_id }}" {{ in_array($med->medication_id, $selectedIds ?? []) ? 'selected' : '' }}>
                                {{ $med->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">فحص التفاعلات</button>
            </form>
        </div>
    </div>

    @if(!empty($selectedIds))
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">نتائج التداخلات</div>
            <div class="card-body">
                @if($interactions->isEmpty())
                    <div class="alert alert-success">لا توجد تداخلات بين الأدوية المحددة.</div>
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>الدواء</th>
                            <th>يتفاعل مع</th>
                            <th>الملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($interactions as $medId => $rows)
                            @foreach($rows as $interaction)
                                <tr>
                                    <td>{{ $interaction->medication->name ?? 'N/A' }}</td>
                                    <td>{{ $interaction->interactsWith->name ?? 'N/A' }}</td>
                                    <td>{{ $interaction->notes ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @endif
        </main>
@endsection

