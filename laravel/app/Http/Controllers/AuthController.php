<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserWaPoliester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:user_wa_poliesters',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $userWaPoliester = UserWaPoliester::create([
            'token' => bin2hex(random_bytes(16)), // Generate a unique token
            'user_id' => $user->id, // Link to the user ID
            'domain_hit' => 'https://caseoptheligaandnewligawkwkkw.progesio.my.id',
            'token_limit' => 10, // Default token limit
        ]);

        // jika ada yang berhasil register kirim pesan notifikasi ke nomor 082111424592, ada user baru yang mendaftar
        $nomor = '082111424592';
        $pesan = 'Ada user baru yang mendaftar dengan email: ' . $validatedData['email'];
        Http::get('https://caseoptheligaandnewligawkwkkw.progesio.my.id/api/use-token?no=' . $nomor . '&mass=' . $pesan);

        return redirect()->route('login')->with('success', 'Kamu sudah berhasil registrasi');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }


        $user = Auth::user();

        return redirect()->route('dashboard');
    }
}
