<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\master_akun;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        Log::info('Menampilkan halaman login');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Proses login dimulai', ['nik' => $request->nik]);

        $request->validate([
            'nik' => 'required|string|size:16',
            'password' => 'required|string',
        ]);

        // cek user berdasarkan nik
        $user = master_akun::where('nik', $request->nik)->first();

        if (!$user) {
            Log::warning('Login gagal: user tidak ditemukan', ['nik' => $request->nik]);
            return back()->with('error', 'NIK atau Password salah');
        }

        Log::info('User ditemukan', [
            'nik' => $user->nik,
            'level' => $user->level
        ]);

        // cek password
        if (!Hash::check($request->password, $user->password)) {
            Log::warning('Login gagal: password salah', ['nik' => $user->nik]);
            return back()->with('error', 'NIK atau Password salah');
        }

        // login user
        Auth::login($user);

        // regenerate session (penting untuk auth)
        $request->session()->regenerate();

        Log::info('User berhasil login', ['nik' => $user->nik]);

        // ambil nama dari tabel penduduk
        $penduduk = DB::table('master_penduduks')
            ->where('nik', $user->nik)
            ->first();

        $nama = $penduduk ? $penduduk->nama_lengkap : $user->nik;

        session(['nama' => $nama]);

        Log::info('Nama disimpan di session', ['nama' => $nama]);

        // redirect sesuai level akun
        switch ($user->level) {

            case 1:
                Log::info('Redirect ke dashboard admin');
                return redirect('/admin/dashboard')
                    ->with('success', 'Login sebagai Admin');

            case 2:
                Log::info('Redirect ke dashboard RW');
                return redirect('/rw/dashboard-rw')
                    ->with('success', 'Login sebagai RW');

            case 3:
                Log::info('Redirect ke dashboard RT');
                return redirect('/rt/dashboard-rt')
                    ->with('success', 'Login sebagai RT');

            default:
                Auth::logout();
                Log::error('Level akun tidak dikenali', ['level' => $user->level]);

                return redirect()->route('login')
                    ->with('error', 'Level akun tidak dikenali');
        }
    }

    public function logout(Request $request)
    {
        Log::info('Logout user', [
            'nik' => optional(Auth::user())->nik
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout');
    }

    public function getNama()
    {
        if (Auth::check()) {

            $user = Auth::user();

            $nama = DB::table('master_penduduks')
                ->where('nik', $user->nik)
                ->value('nama_lengkap');

            return $nama ?? $user->nik;
        }

        return null;
    }
}