<div class="row">
    <!-- Patient Selection -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('المريض') }} <span class="text-danger">*</span></label>
            <select name="patient_id" class="form-control select2" required>
                <option value="">-- اختر المريض --</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->patient_id }}"
                        {{ (old('patient_id', $prescription->patient_id ?? '') == $patient->patient_id) ? 'selected' : '' }}>
                        {{ $patient->user->first_name ?? '' }} {{ $patient->user->last_name ?? '' }}
                        (ID: {{ $patient->patient_id }})
                    </option>
                @endforeach
            </select>
            @error('patient_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Pharmacy Selection -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الصيدلية') }}</label>
            <select name="pharmacy_id" class="form-control select2">
                <option value="">-- اختر الصيدلية --</option>
                @foreach ($pharmacies as $pharmacy)
                    <option value="{{ $pharmacy->pharmacy_id }}"
                        {{ (old('pharmacy_id', $prescription->pharmacy_id ?? '') == $pharmacy->pharmacy_id) ? 'selected' : '' }}>
                        {{ $pharmacy->pharmacy_name }} (ID: {{ $pharmacy->pharmacy_id }})
                    </option>
                @endforeach
            </select>
            @error('pharmacy_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- row -->

<div class="row">
    <!-- date_issued -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('تاريخ الإصدار') }} <span class="text-danger">*</span></label>
            <input type="date" name="date_issued" class="form-control" required
                   value="{{ old('date_issued', $prescription->date_issued ?? '') }}">
            @error('date_issued')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- expiration_date -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('تاريخ الانتهاء') }}</label>
            <input type="date" name="expiration_date" class="form-control"
                   value="{{ old('expiration_date', $prescription->expiration_date ?? '') }}">
            @error('expiration_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- row -->

<div class="row">
    <!-- status -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الحالة') }}</label>
            <input type="text" name="status" class="form-control"
                   value="{{ old('status', $prescription->status ?? 'active') }}">
            @error('status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- dosage -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الجرعة') }}</label>
            <input type="text" name="dosage" class="form-control"
                   value="{{ old('dosage', $prescription->dosage ?? '') }}">
            @error('dosage')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- row -->

<div class="row">
    <!-- instructions -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('التعليمات') }}</label>
            <textarea name="instructions" class="form-control" rows="3">{{ old('instructions', $prescription->instructions ?? '') }}</textarea>
            @error('instructions')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- refills_remaining -->
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('عدد التجديدات المتبقية') }}</label>
            <input type="number" name="refills_remaining" class="form-control"
                   value="{{ old('refills_remaining', $prescription->refills_remaining ?? 0) }}">
            @error('refills_remaining')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- row -->

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('الأدوية') }}</label>
            <select name="medications[]" class="form-control select2" multiple>
                <option value="">-- اختر الأدوية --</option>
                @foreach ($medications as $medication)
                    <option value="{{ $medication->medication_id }}"
                        {{ in_array($medication->medication_id, $selectedMeds ?? []) ? 'selected' : '' }}>
                        {{ $medication->name }} ({{ $medication->strength }})
                    </option>
                @endforeach
            </select>
            @error('medications')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

