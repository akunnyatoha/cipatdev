<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('landingpage.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            if (Auth::user()->role->name == 'Admin') {
                return redirect()->route('dashboard');
            } else if(Auth::user()->role->name == 'Dekan'){
                return redirect()->route('dashboard');
            } else if(Auth::user()->role->name == 'BKA'){
                return redirect()->route('dashboard');
            }  else if(Auth::user()->role->name == 'Perkuliahan'){
                return redirect()->route('dashboard');
            }  else {
                return redirect()->route('landing');
            }
        }
        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }
}
