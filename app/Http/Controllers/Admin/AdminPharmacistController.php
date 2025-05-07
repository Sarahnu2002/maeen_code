<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPharmacistController extends Controller
{
    public function index()
    {
        $pharmacists = Pharmacist::with('user')->get();
        return view('admin.pharmacists.index', compact('pharmacists'));
    }

    public function create()
    {
        return view('admin.pharmacists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:user,email',
            'phone'      => 'required',
            'password'   => 'required|min:8|confirmed',
            'pharmacy_name' => 'required'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'user_type'  => 'pharmacist',
        ]);

        Pharmacist::create([
            'user_id' => $user->user_id,
            'pharmacy_name' => $request->pharmacy_name
        ]);

        return redirect()->route('admin.pharmacists.index')->with('success', 'تمت إضافة الصيدلي بنجاح');
    }

    public function edit($id)
    {
        $pharmacist = Pharmacist::with('user')->findOrFail($id);
        return view('admin.pharmacists.edit', compact('pharmacist'));
    }

    public function update(Request $request, $id)
    {
        $pharmacist = Pharmacist::findOrFail($id);
        $user = $pharmacist->user;

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:user,email,' . $user->user_id,
            'phone'      => 'required',
            'pharmacy_name' => 'required'
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

        $pharmacist->update([
            'pharmacy_name' => $request->pharmacy_name
        ]);

        return redirect()->route('admin.pharmacists.index')->with('success', 'تم تحديث بيانات الصيدلي');
    }

    public function destroy($id)
    {
        $pharmacist = Pharmacist::findOrFail($id);
        $pharmacist->user()->delete();
        $pharmacist->delete();

        return redirect()->back()->with('success', 'تم حذف الصيدلي');
    }
}
