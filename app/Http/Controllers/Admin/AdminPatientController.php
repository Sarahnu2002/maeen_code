<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('user')->get();
        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'required|email|unique:user,email',
            'phone'        => 'required',
            'password'     => 'required|min:8|confirmed',
//            'national_id'  => 'required|unique:patient,national_id'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'user_type'  => 'patient',
        ]);

        Patient::create([
            'user_id'     => $user->user_id,
//            'national_id' => $request->national_id,
        ]);

        return redirect()->route('admin.patients.index')->with('success', 'تمت إضافة المريض بنجاح');
    }

    public function edit($id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;

        $request->validate([
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'required|email|unique:user,email,' . $user->user,
            'phone'        => 'required',
//            'national_id'  => 'required|unique:patient,national_id,' . $patient->patient_id,
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

//        $patient->update(['national_id' => $request->national_id]);

        return redirect()->route('admin.patients.index')->with('success', 'تم تحديث بيانات المريض');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
//        dd($patient);
//        $patient->user()->delete();
        $patient->delete();

        return redirect()->back()->with('success', 'تم حذف المريض');
    }
}
