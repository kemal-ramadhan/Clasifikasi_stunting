<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Charts\StuntingDashboardChart;

class AdminController extends Controller
{
    public function akses()
    {
        return view('admin.akses',[
            'title' => 'Akses Masuk'
        ]);
    }
    
    public function dashboard(StuntingDashboardChart $chart)
    {
        return view('admin.index',[
            'title' => 'Dashboard',
            'stunting' => $chart->build(),
        ]);
    }

    public function authenticate(Request $request)
    {
        $credit = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('admin')->attempt($credit)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
 
        return back()->with('LoginError', 'Akses Masuk Salah, Periksa lagi akses masuknya!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/administrator')->with('LoginError', 'Logout Success!');
    }
}
