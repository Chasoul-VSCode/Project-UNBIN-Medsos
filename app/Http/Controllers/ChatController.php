<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'sebut' => 'required|string|max:255',
        ]);

        // Create a new chat entry
        Chat::create([
            'pengirim' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => now(),
            'sebut' => $request->sebut,
        ]);

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Post berhasil dibuat!');
    }
}
