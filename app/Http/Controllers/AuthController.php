<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Pharmacist;
use App\Models\Patient;

class AuthController extends Controller
{

    public function home()
    {
        return view('admin.index');
    }

    public function showRegisterForm(Request $request)
    {
        $type = $request->query('type', 'patient');
        return view('website.register_process', compact('type'));
    }

    public function handleRegister(Request $request)
    {
        $type = $request->input('type', 'patient');

        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'username'   => 'required|string|max:50|unique:User,username',
            'email'      => 'required|email|unique:User,email',
            'phone'      => [
                'required',
                'unique:User,phone',
                'regex:/^(05\d{8}|9665\d{8})$/'
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/'
            ]
        ];

        if ($type === 'doctor') {
            $rules['specialization'] = 'required|string|max:100';
            $rules['department']     = 'nullable|string|max:100';
            $rules['clinic_address'] = 'required|string';
            $rules['license_number'] = 'required|string|max:50';
            $rules['work_hours']     = 'required|string|max:100';
        } elseif ($type === 'pharmacist') {
            $rules['shift_timings']   = 'required|string|max:100';
            $rules['qualification']   = 'required|string|max:100';
            $rules['employee_number'] = 'required|string|max:50';
        } else {
            $rules['medical_history']   = 'nullable|string';
            $rules['address']           = 'required|string';
            $rules['allergies']         = 'nullable|string';
            $rules['insurance_info']    = 'nullable|string';
            $rules['date_of_birth']     = 'required|date';
            $rules['emergency_contact'] = 'nullable|string|max:50';
        }

        $validatedData = $request->validate($rules);

        DB::beginTransaction();
        try {
            $user = new User();
            $user->first_name = $validatedData['first_name'];
            $user->last_name  = $validatedData['last_name'];
            $user->username   = $validatedData['username'];
            $user->email      = $validatedData['email'];
            $user->phone      = $validatedData['phone'];
            $user->password   = Hash::make($validatedData['password']);
            $user->status     = 'active';
            $user->registration_date = now();
            $user->save();
            if ($type === 'doctor') {
                $doctor = new Doctor();
                $doctor->user_id        = $user->user_id;
                $doctor->specialization = $validatedData['specialization'];
                $doctor->department     = $validatedData['department'] ?? null;
                $doctor->clinic_address = $validatedData['clinic_address'];
                $doctor->license_number = $validatedData['license_number'];
                $doctor->work_hours     = $validatedData['work_hours'];
                $doctor->save();
            } elseif ($type === 'pharmacist') {
                $pharmacist = new Pharmacist();
                $pharmacist->user_id         = $user->user_id;
                $pharmacist->shift_timings   = $validatedData['shift_timings'];
                $pharmacist->qualification   = $validatedData['qualification'];
                $pharmacist->employee_number = $validatedData['employee_number'];
                $pharmacist->save();
            } else {
                $patient = new Patient();
                $patient->user_id           = $user->user_id;
                $patient->medical_history   = $validatedData['medical_history'] ?? null;
                $patient->address           = $validatedData['address'];
                $patient->allergies         = $validatedData['allergies'] ?? null;
                $patient->insurance_info    = $validatedData['insurance_info'] ?? null;
                $patient->date_of_birth     = $validatedData['date_of_birth'];
                $patient->emergency_contact = $validatedData['emergency_contact'] ?? null;
                $patient->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }

        return redirect()->route('login')
            ->with('success', 'تم التسجيل بنجاح! يمكنك الآن تسجيل الدخول.');
    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'type'     => 'required|in:admin,doctor,pharmacist,patient',
            'login'    => 'required',
            'password' => 'required',
        ]);
        $loginValue = $request->input('login');
        $field = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [
            $field     => $loginValue,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
//             if (Auth::user()->type !== $request->type) {
//                 Auth::logout();
//                 return redirect()->back()->withErrors(['error' => 'User type mismatch.']);
//             }
            $route = 'admin.dashboard';
            if (auth()->user()->doctor) {
                $route = 'doctor.dashboard';
            }
            if (auth()->user()->patient) {
                $route = 'patient.dashboard';
            }
            if (auth()->user()->pharmacist) {
                $route = 'pharmacist.dashboard';
            }
            return redirect()->route($route)->with('success', 'Login successful.');
        }
        return redirect()->back()->withInput()->withErrors(['error' => 'Invalid credentials.']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
