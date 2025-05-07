<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // عرض الصفحة الرئيسية
    public function home()
    {
        return view('website.home');
    }

    // عرض صفحة "عن التطبيق"
    public function about()
    {
        return view('website.about');
    }

    // عرض صفحة "التطبيقات"
    public function services()
    {
        return view('website.services');
    }

    // عرض صفحة "انضم إلينا الآن"
    public function joinUs()
    {
        return view('website.join');
    }
    public function contact()
    {
        return view('website.contact');
    }


    public function choose_type_login(Request $request)
    {
        $type = $request->query('type');
        return view('website.login', compact('type'));
    }

    public function choose_type_register(Request $request)
    {
        $type = $request->query('type');
        return view('website.register', compact('type'));
    }
}
