<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required', 
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $user = User::find(auth()->user()->id);

            log::create([
                'id_user' => $user->id,
                'activity' => 'Data Login'
            ]);

            if($user->role === 'admin')
            {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
             elseif($user->role === 'kasir')
            {
                $request->session()->regenerate();
                return redirect()->intended('/DashboardKasir');
            }
            elseif($user->role === 'owner')
            {
                $request->session()->regenerate();
                return redirect()->intended('/DashboardOwner');
            }
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout()
    {

        $user = User::find(auth()->user()->id);
        
                log::create([
                    'id_user' => $user->id,
                    'activity' => 'LogOut'
                ]);



        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}