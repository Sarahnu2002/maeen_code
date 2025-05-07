<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorPortalController extends Controller
{
    public function dashboard()
    {
        $doctor = Auth::user()->doctor;
        if (!$doctor) {
            abort(403, 'Not a doctor.');
        }
        $prescriptionCount = Prescription::where('doctor_id', $doctor->doctor_id)->count();
        $medicationCount = DB::table('Prescription_Medication')
            ->join('Prescription', 'Prescription.prescription_id', '=', 'Prescription_Medication.prescription_id')
            ->where('Prescription.doctor_id', $doctor->doctor_id)
            ->distinct('Prescription_Medication.medication_id')
            ->count('Prescription_Medication.medication_id');
        $consultationCount = 12;

        $chartLabels = ["يناير", "فبراير", "مارس", "أبريل", "مايو"];
        $chartValues = [5, 8, 4, 10, 7];

        return view('doctor.dashboard', compact(
            'prescriptionCount',
            'medicationCount',
            'consultationCount',
            'chartLabels',
            'chartValues'
        ));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $doctor = $user->doctor;
        if (!$doctor) {
            abort(403, 'Not a doctor.');
        }
        return view('doctor.profile_edit', compact('user', 'doctor'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $doctor = $user->doctor;

        if (!$doctor) {
            abort(403, 'Not a doctor.');
        }
        $request->validate([
            // Basic user fields
            'first_name'     => 'required|max:50',
            'last_name'      => 'required|max:50',
            'email'          => 'required|email|unique:User,email,'.$user->user_id.',user_id',
            'phone'          => 'required|unique:User,phone,'.$user->user_id.',user_id',
            'password'       => 'nullable|confirmed|min:8',
            // Doctor fields
            'specialization' => 'required|max:100',
            'department'     => 'nullable|max:100',
            'clinic_address' => 'required',
            'license_number' => 'required|max:50',
            'work_hours'     => 'required|max:100',
        ]);

        DB::beginTransaction();
        try {
            // Update user info
            $user->first_name = $request->input('first_name');
            $user->last_name  = $request->input('last_name');
            $user->email      = $request->input('email');
            $user->phone      = $request->input('phone');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            // Update doctor info
            $doctor->specialization = $request->input('specialization');
            $doctor->department     = $request->input('department');
            $doctor->clinic_address = $request->input('clinic_address');
            $doctor->license_number = $request->input('license_number');
            $doctor->work_hours     = $request->input('work_hours');
            $doctor->save();

            DB::commit();
            return redirect()->route('doctor.dashboard')
                ->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error updating profile: '.$e->getMessage()]);
        }
    }
}
