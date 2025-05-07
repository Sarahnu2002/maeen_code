
<div class="alert alert-warning" role="alert">
    <strong>تنبيه:</strong>
    يُرجى التحقق أولاً من عدم وجود دواء بالاسم نفسه لتجنب التكرار.
    كما يُنصَح بمراجعة التعليمات والتفاعلات الدوائية بعناية.
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('اسم الدواء') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $medication->name ?? '') }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('العيار') }} <span class="text-danger">*</span></label>
            <input type="text" name="strength" class="form-control"
                   value="{{ old('strength', $medication->strength ?? '') }}" required>
            @error('strength')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- /row -->

<div class="row">
    <!-- Dosage Form -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الشكل الصيدلاني') }}</label>
            <input type="text" name="dosage_form" class="form-control"
                   value="{{ old('dosage_form', $medication->dosage_form ?? '') }}">
            @error('dosage_form')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Barcode -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الباركود') }}</label>
            <input type="text" name="barcode" class="form-control"
                   value="{{ old('barcode', $medication->barcode ?? '') }}">
            @error('barcode')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- /row -->
<div class="row">
    <!-- Storage Conditions -->
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('شروط التخزين') }}</label>
            <textarea name="storage_conditions" class="form-control" rows="2">
                {{ old('storage_conditions', $medication->storage_conditions ?? '') }}
            </textarea>
            @error('storage_conditions')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- /row -->
<div class="row">
    <!-- Manufacturer -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الشركة المصنعة') }}</label>
            <input type="text" name="manufacturer" class="form-control"
                   value="{{ old('manufacturer', $medication->manufacturer ?? '') }}">
            @error('manufacturer')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="card border-primary mt-4">
    <div class="card-header bg-primary text-white">
        التفاعلات الدوائية
    </div>
    <div class="card-body">

        <div class="form-group mb-3">
            <label>اختر الأدوية التي تتفاعل مع هذا الدواء</label>
            <select id="interaction-select" class="form-control select2" style="width: 100%;">
                <option value="">-- اختر دواء --</option>
                @foreach($allMedications as $med)
                    @if (!isset($medication) || $med->medication_id != $medication->medication_id)
                        <option value="{{ $med->medication_id }}" data-name="{{ $med->name }}">
                            {{ $med->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <table class="table table-bordered" id="interaction-table">
            <thead>
            <tr>
                <th>الدواء المتفاعل</th>
                <th>ملاحظات</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($medicationInteractions))
                @foreach($medicationInteractions as $id => $interaction)
                    @php $med = $allMedications->find($interaction->id); @endphp
                    @if($med)
{{--                        @dump($med)--}}
                        <tr data-id="{{ $med->medication_id }}">
                            <td>
                                {{ $med->name }}
                                <input type="hidden" name="interacts_with[{{ $med->medication_id }}][medication_id]" value="1">
                            </td>
                            <td>
                                <input type="text" name="interacts_with[{{ $med->medication_id }}][notes]" class="form-control" value="{{ $interaction->notes }}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">✖</button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>

    </div>
</div>


@push('js')
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>--}}
    <script>
        $(document).ready(function () {
            $('#interaction-select').on('select2:select', function (e) {
                const id = e.params.data.id
                console.log(e.params.data);
                const name = e.params.data.element.dataset.name;
                if ($('#interaction-table tbody').find(`tr[data-id="${id}"]`).length > 0) {
                    $(this).val(null).trigger('change');
                    $('#interaction-select').select2();
                    return;
                }
                const newRow = `
            <tr data-id="${id}">
                <td>
                    ${name}
                    <input type="hidden" name="interacts_with[${id}][medication_id]" value="1">
                </td>
                <td>
                    <input type="text" name="interacts_with[${id}][notes]" class="form-control" placeholder="ملاحظات">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">✖</button>
                </td>
            </tr>
        `;

                $('#interaction-table tbody').append(newRow);
                $('#interaction-select').select2();
                $(this).val(null).trigger('change');
            });

            // حذف الصف
            $('#interaction-table').on('click', '.remove-row', function () {
                $('#interaction-select').select2();
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush
