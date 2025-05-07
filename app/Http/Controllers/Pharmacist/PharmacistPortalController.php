<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use App\Models\Pharmacist;
use App\Models\Prescription;
use App\Models\PrescriptionDispense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PharmacistPortalController extends Controller
{
    public function dashboard()
    {
        $pharmacist = Auth::user()->pharmacist;
        if (!$pharmacist) {
            abort(403, 'Not a pharmacist.');
        }

        // احصائيات
        $prescriptionCount = DB::table('Prescription')->count();
        $medicationCount = DB::table('Medication')->count();
        $patientCount = DB::table('Patient')->count();

        // بيانات المخطط البياني
        $chartLabels = ["يناير", "فبراير", "مارس", "أبريل", "مايو"];
        $chartValues = [7, 12, 9, 15, 10];

        return view('pharmacist.dashboard', compact(
            'prescriptionCount',
            'medicationCount',
            'patientCount',
            'chartLabels',
            'chartValues'
        ));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $pharmacist = $user->pharmacist;
        if (!$pharmacist) {
            abort(403, 'Not a pharmacist.');
        }
        return view('pharmacist.profile_edit', compact('user', 'pharmacist'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $pharmacist = $user->pharmacist;
        if (!$pharmacist) {
            abort(403, 'Not a pharmacist.');
        }
        $request->validate([
            'first_name'       => 'required|max:50',
            'last_name'        => 'required|max:50',
            'email'            => 'required|email|unique:User,email,'.$user->user_id.',user_id',
            'phone'            => 'required|unique:User,phone,'.$user->user_id.',user_id',
            'password'         => 'nullable|confirmed|min:8',
            'shift_timings'    => 'required|max:100',
            'qualification'    => 'required|max:100',
            'employee_number'  => 'required|max:50',
        ]);
        DB::beginTransaction();
        try {
            $user->first_name = $request->input('first_name');
            $user->last_name  = $request->input('last_name');
            $user->email      = $request->input('email');
            $user->phone      = $request->input('phone');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();
            $pharmacist->shift_timings = $request->input('shift_timings');
            $pharmacist->qualification = $request->input('qualification');
            $pharmacist->employee_number = $request->input('employee_number');
            $pharmacist->save();

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
        $prescriptions = Prescription::get();
        return view('pharmacist.prescriptions', compact('prescriptions'));
    }



    public function dispense(Request $request, Prescription $prescription)
    {
        $pharmacist = Auth::user()->pharmacist;
        if (!$pharmacist) {
            abort(403, 'غير مصرح.');
        }

        $alreadyDispensed = PrescriptionDispense::where('prescription_id', $prescription->prescription_id)->exists();
        if ($alreadyDispensed) {
            return back()->withErrors(['error' => 'تم صرف هذه الوصفة مسبقًا.']);
        }

        PrescriptionDispense::create([
            'prescription_id' => $prescription->prescription_id,
            'pharmacist_id' => $pharmacist->pharmacist_id,
            'dispensed_at' => now(),
            'status' => 'dispensed',
            'notes' => null,
        ]);

        return back()->with('success', 'تم صرف الوصفة الطبية بنجاح.');
    }

}
