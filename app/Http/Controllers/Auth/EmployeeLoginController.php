<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function show_login_form() {
        return view('auth.login');
    }

    public function process_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = Employee::where('username',$request->username)->first();

        if (auth()->attempt($credentials)) {

            return redirect()->route('dashboard');

        }else{
            return redirect()->back()->with('error', 'Username/Password is wrong');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('monitoring');
    }
}
