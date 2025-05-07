<?php

namespace App\Http\Controllers;

use App\Models\MedicationInteraction;
use Illuminate\Http\Request;
use App\Models\Medication;

class MedicationController extends Controller
{
    public function index()
    {
        $medications = Medication::orderBy('medication_id', 'desc')->get();
        return view('medications.index', compact('medications'));
    }

    public function create()
    {
        $allMedications = Medication::all();
        return view('medications.create', compact('allMedications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:medication,name|string|max:100',
            'strength' => 'required|string|max:50',
            'dosage_form' => 'nullable|string|max:50',
            'barcode' => 'nullable|string|max:50',
            'manufacturer' => 'nullable|string|max:100',
            'interactions' => 'nullable|string',
            'storage_conditions' => 'nullable|string',
        ]);

        $medication = Medication::create($request->all());
        if ($request->has('interacts_with')) {
            foreach ($request->interacts_with as $interactId => $data) {
                MedicationInteraction::create([
                    'medication_id' => $medication->medication_id,
                    'interacts_with_id' => $interactId,
                    'notes' => $data['notes'] ?? null,
                ]);
            }
        }
        return redirect()->route('medications.index')
            ->with('success', 'تم إضافة الدواء بنجاح!');
    }

    public function edit(Medication $medication)
    {
        $allMedications = Medication::all();
        $medicationInteractions = $medication->interactions()->get();
        return view('medications.edit', compact('medication', 'allMedications', 'medicationInteractions'));

    }

    public function update(Request $request, Medication $medication)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:Medication,name,'
                . $medication->medication_id . ',medication_id',
            'strength' => 'required|string|max:50',
            'dosage_form' => 'nullable|string|max:50',
            'barcode' => 'nullable|string|max:50',
            'manufacturer' => 'nullable|string|max:100',
            'interactions' => 'nullable|string',
            'storage_conditions' => 'nullable|string',
        ]);
//        dd($request->interacts_with);
        $medication->update($request->all());
        $medication->interactions()->delete();

        if ($request->has('interacts_with')) {
            foreach ($request->interacts_with as $interactId => $data) {
                MedicationInteraction::create([
                    'medication_id' => $medication->medication_id,
                    'interacts_with_id' => $interactId,
                    'notes' => $data['notes'] ?? null,
                ]);
            }
        }
        return redirect()->route('medications.index')
            ->with('success', 'تم تحديث الدواء بنجاح!');
    }

    public function destroy(Medication $medication)
    {
        $medication->delete();

        return redirect()->route('medications.index')
            ->with('success', 'تم حذف الدواء بنجاح!');
    }


    public function checkInteractions(Request $request)
    {
        $medications = Medication::all();
        $interactions = collect();
        $selectedIds = [];

        if ($request->isMethod('post')) {
            $request->validate([
                'medication_ids' => 'required|array|min:2',
                'medication_ids.*' => 'exists:Medication,medication_id'
            ]);

            $selectedIds = $request->medication_ids;

            $interactions = MedicationInteraction::whereIn('medication_id', $selectedIds)
                ->whereIn('interacts_with_id', $selectedIds)
                ->get()
                ->groupBy('medication_id');
        }

        return view('medications.check', compact('medications', 'interactions', 'selectedIds'));
    }


}
