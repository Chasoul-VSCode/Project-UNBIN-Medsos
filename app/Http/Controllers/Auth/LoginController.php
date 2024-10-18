<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();
        $user->status = 1;
        $user->save();

        return redirect()->intended(route('dashboard'));
    }

    return back()->withErrors([
        'username' => 'username dan password salah',
    ]);
}


   public function logout(Request $request)
{

    $user = Auth::user();

    if ($user) {
        $user->status = 0;
        $user->save();
    }

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}

}
