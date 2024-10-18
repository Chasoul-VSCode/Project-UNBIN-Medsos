<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'npm' => 'required|string|min:3|max:20|unique:users,npm',
            'username' => 'required|string|min:3|max:20|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan pengguna baru
        User::create([
            'email' => $request->email,
            'npm' => $request->npm,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 0, 
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
}
