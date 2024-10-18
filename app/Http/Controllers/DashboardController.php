<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Dapatkan informasi pengguna yang sedang login
        $user = Auth::user();

        // Anda dapat mengambil data lain yang diperlukan di sini, misalnya:
        // $activities = Activity::where('user_id', $user->id)->get();

        return view('pages.dashboard', compact('user')); // Kirim data pengguna ke view
    }
}
