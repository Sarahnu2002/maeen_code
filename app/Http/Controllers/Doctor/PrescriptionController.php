<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use App\Models\Patient;
use App\Models\Pharmacy;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;
        if (!$doctor) {
            abort(403, 'Not a doctor.');
        }
        $prescriptions = Prescription::where('doctor_id', $doctor->doctor_id)
            ->with('patient.user', 'doctor.user', 'pharmacy')
            ->get();
        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $doctor = Auth::user()->doctor;
        if (!$doctor) {
            abort(403, 'Not a doctor.');
        }
        $patients = Patient::with('user')->get();
        $pharmacies = Pharmacy::all();
        $medications = Medication::all();

        return view('doctor.prescriptions.create', compact('patients', 'pharmacies', 'medications'));
    }

    public function store(Request $request)
    {
        $doctor = Auth::user()->doctor;
        if (!$doctor) {
            abort(403, 'Not a doctor.');
        }
        $request->validate([
            'patient_id'         => 'required|exists:Patient,patient_id',
            'pharmacy_id'        => 'nullable|exists:Pharmacy,pharmacy_id',
            'date_issued'        => 'required|date',
            'expiration_date'    => 'nullable|date',
            'instructions'       => 'nullable|string',
            'status'             => 'nullable|string',
            'dosage'             => 'nullable|string',
            'refills_remaining'  => 'nullable|integer',
            'medications'        => 'array',
            'medications.*'      => 'exists:Medication,medication_id',
        ]);
        $prescription = new Prescription();
        $prescription->doctor_id         = $doctor->doctor_id;
        $prescription->patient_id        = $request->input('patient_id');
        $prescription->pharmacy_id       = $request->input('pharmacy_id'); // from the new select
        $prescription->date_issued       = $request->input('date_issued');
        $prescription->expiration_date   = $request->input('expiration_date');
        $prescription->instructions      = $request->input('instructions');
        $prescription->status            = $request->input('status', 'active');
        $prescription->dosage            = $request->input('dosage');
        $prescription->refills_remaining = $request->input('refills_remaining', 0);
        $prescription->save();
        if ($request->has('medications')) {
            $prescription->medications()->attach($request->input('medications'));
        }
        return redirect()->route('doctor.prescriptions.index')
            ->with('success', 'Prescription created successfully.');
    }

    public function show($id)
    {
        $doctor = Auth::user()->doctor;
        $prescription = Prescription::with('patient.user', 'medications')
            ->where('doctor_id', $doctor->doctor_id)
            ->findOrFail($id);
        return view('doctor.prescriptions.show', compact('prescription'));
    }

    public function edit($id)
    {
        $doctor = Auth::user()->doctor;
        $prescription = Prescription::where('doctor_id', $doctor->doctor_id)
            ->findOrFail($id);
        $patients = Patient::with('user')->get();
        $pharmacies = Pharmacy::all();
        $medications = Medication::all();
        $selectedMeds = $prescription->medications()
            ->pluck('Medication.medication_id')
            ->toArray();
        return view('doctor.prescriptions.edit', compact(
            'prescription',
            'patients',
            'pharmacies',
            'medications',
            'selectedMeds'
        ));
    }

    public function update(Request $request, $id)
    {
        $doctor = Auth::user()->doctor;
        $prescription = Prescription::where('doctor_id', $doctor->doctor_id)
            ->findOrFail($id);

        $request->validate([
            'patient_id'         => 'required|exists:Patient,patient_id',
            'pharmacy_id'        => 'nullable|exists:Pharmacy,pharmacy_id',
            'date_issued'        => 'required|date',
            'expiration_date'    => 'nullable|date',
            'instructions'       => 'nullable|string',
            'status'             => 'nullable|string',
            'dosage'             => 'nullable|string',
            'refills_remaining'  => 'nullable|integer',
            'medications'        => 'array',
            'medications.*'      => 'exists:Medication,medication_id',
        ]);

        $prescription->patient_id        = $request->input('patient_id');
        $prescription->pharmacy_id       = $request->input('pharmacy_id');
        $prescription->date_issued       = $request->input('date_issued');
        $prescription->expiration_date   = $request->input('expiration_date');
        $prescription->instructions      = $request->input('instructions');
        $prescription->status            = $request->input('status', 'active');
        $prescription->dosage            = $request->input('dosage');
        $prescription->refills_remaining = $request->input('refills_remaining', 0);
        $prescription->save();

        $prescription->medications()->sync($request->input('medications', []));

        return redirect()->route('doctor.prescriptions.index')
            ->with('success', 'Prescription updated successfully.');
    }

    public function destroy($id)
    {
        $doctor = Auth::user()->doctor;
        $prescription = Prescription::where('doctor_id', $doctor->doctor_id)
            ->findOrFail($id);

        // Detach pivot if needed
        $prescription->medications()->detach();
        $prescription->delete();

        return redirect()->route('doctor.prescriptions.index')
            ->with('success', 'Prescription deleted successfully.');
    }
}
