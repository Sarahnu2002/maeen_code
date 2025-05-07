<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Pharmacist;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminPortalController extends Controller
{
    public function dashboard()
    {
        // إحصائيات النظام
        $doctorCount = DB::table('Doctor')->count();
        $patientCount = DB::table('Patient')->count();
        $pharmacistCount = DB::table('Pharmacist')->count();
        $prescriptionCount = DB::table('Prescription')->count();

        // بيانات المخطط البياني
        $chartLabels = ["يناير", "فبراير", "مارس", "أبريل", "مايو"];
        $chartValues = [20, 35, 40, 55, 65];

        return view('admin.dashboard', compact(
            'doctorCount',
            'patientCount',
            'pharmacistCount',
            'prescriptionCount',
            'chartLabels',
            'chartValues'
        ));
    }

    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'username'      => 'required|max:50|unique:Administrator,username,'.$admin->id,
            'email'         => 'required|email|unique:Administrator,email,'.$admin->id,
            'phone'         => 'required|unique:Administrator,phone,'.$admin->id,
            'role'          => 'required|max:50',
            'password'      => 'nullable|confirmed|min:8',
        ]);

        DB::beginTransaction();
        try {
            // تحديث بيانات المشرف
            $admin->username  = $request->input('username');
            $admin->email     = $request->input('email');
            $admin->phone     = $request->input('phone');
            $admin->role      = $request->input('role');

            if ($request->filled('password')) {
                $admin->password = Hash::make($request->input('password'));
            }

            $admin->save();
            DB::commit();

            return redirect()->route('admin.dashboard')->with('success', 'تم تحديث الملف الشخصي بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'حدث خطأ أثناء التحديث: '.$e->getMessage()]);
        }
    }

    public function prescriptions()
    {
        $prescriptions = Prescription::get();
        return view('admin.prescriptions', compact('prescriptions'));
    }


    public function listDoctors()
    {
        $doctors = Doctor::with('user')->get();
        return view('admin.doctors', compact('doctors'));
    }

    public function listPharmacists()
    {
        $pharmacists = Pharmacist::with('user')->get();
        return view('admin.pharmacists', compact('pharmacists'));
    }

    public function listPatients()
    {
        $patients = Patient::with('user')->get();
        return view('admin.patients', compact('patients'));
    }

}
