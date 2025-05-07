<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientPortalController extends Controller
{
    public function dashboard()
    {
        $patient = Auth::user()->patient;
        if (!$patient) {
            abort(403, 'Not a patient.');
        }
        $prescriptionCount = $patient->prescriptions()->count();
        $doctorCount = DB::table('Doctor')->count();
        $pharmacistCount = DB::table('Pharmacist')->count();
        $chartLabels = ["يناير", "فبراير", "مارس", "أبريل", "مايو"];
        $chartValues = [3, 5, 8, 6, 9];
        return view('patient.dashboard', compact(
            'prescriptionCount',
            'doctorCount',
            'pharmacistCount',
            'chartLabels',
            'chartValues'
        ));
    }
    public function editProfile()
    {
        $user = Auth::user();
        $patient = $user->patient;
        if (!$patient) {
            abort(403, 'Not a patient.');
        }
        return view('patient.profile_edit', compact('user', 'patient'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $patient = $user->patient;

        if (!$patient) {
            abort(403, 'Not a patient.');
        }
        $request->validate([
            'first_name'       => 'required|max:50',
            'last_name'        => 'required|max:50',
            'email'            => 'required|email|unique:User,email,'.$user->user_id.',user_id',
            'phone'            => 'required|unique:User,phone,'.$user->user_id.',user_id',
            'password'         => 'nullable|confirmed|min:8',
            'address'          => 'required|max:255',
            'medical_history'  => 'nullable|max:1000',
            'allergies'        => 'nullable|max:255',
            'insurance_info'   => 'nullable|max:255',
            'emergency_contact'=> 'required|max:255',
        ]);

        DB::beginTransaction();
        try {
            // تحديث بيانات المستخدم
            $user->first_name = $request->input('first_name');
            $user->last_name  = $request->input('last_name');
            $user->email      = $request->input('email');
            $user->phone      = $request->input('phone');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            $patient->address          = $request->input('address');
            $patient->medical_history  = $request->input('medical_history');
            $patient->allergies        = $request->input('allergies');
            $patient->insurance_info   = $request->input('insurance_info');
            $patient->emergency_contact= $request->input('emergency_contact');
            $patient->save();

            DB::commit();
            return redirect()->back()
                ->with('success', 'تم تحديث الملف الشخصي بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'حدث خطأ أثناء التحديث: '.$e->getMessage()]);
        }
    }


    public function prescriptions()
    {
        $patient = Auth::user()->patient;

        if (!$patient) {
            abort(403, 'Not a patient.');
        }

        $prescriptions = $patient->prescriptions()->with(['doctor.user', 'pharmacy', 'medications'])->get();

        return view('patient.prescriptions', compact('prescriptions'));
    }
}
