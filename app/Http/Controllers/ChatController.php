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

    // Check if the mention is @everyone
    $mention = $request->sebut;
    if ($mention === '@everyone') {
        // Optionally handle logic for mentioning everyone
        $mention = 'Everyone';
    }

    // Get the authenticated user's NPM
    $user = Auth::user();
    $username = $user->username;

    // Create a new chat entry
    Chat::create([
        'pengirim' => $username, // Use NPM instead of Auth::id()
        'judul' => $request->judul,
        'isi' => $request->isi,
        'tanggal' => now(),
        'sebut' => $mention, // Save the mention, either a user or 'Everyone'
    ]);

    // Redirect back to the dashboard with a success message
    return redirect()->route('dashboard')->with('success', 'Post berhasil dibuat!');
}

}
