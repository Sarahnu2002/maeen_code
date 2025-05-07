<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
            'specialty' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'user_type'  => 'doctor',
        ]);

        Doctor::create([
            'user_id'   => $user->user_id,
            'specialty' => $request->specialty,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'تم إضافة الطبيب بنجاح');
    }

    public function edit($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user;

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:user,email,' . $user->user_id,
            'phone'      => 'required',
            'specialty'  => 'required',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $doctor->update([
            'specialty' => $request->specialty
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'تم تحديث بيانات الطبيب');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->user()->delete();
        $doctor->delete();
        return back()->with('success', 'تم حذف الطبيب');
    }
}
