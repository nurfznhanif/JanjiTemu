<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Dosen;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DosenController extends Controller
{
    /**
     * Menampilkan form login untuk dosen.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan daftar dosen.
     */
    public function index()
    {
        $dosens = Dosen::all();
        return view('mahasiswa.reservasi.index', compact('dosens'))->with('user_type', 'mahasiswa');
    }

    /**
     * Dashboard dosen setelah login.
     */
    public function dashboard()
    {
        return view('dosen.dashboard');
    }

    /**
     * Proses login dosen.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login dengan guard 'dosen'
        if (Auth::guard('dosen')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dosen.dashboard');
        }

        // Jika gagal login
        throw ValidationException::withMessages([
            'email' => __('Email atau password salah.'),
        ]);
    }

    /**
     * Proses registrasi dosen baru.
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:dosens'],
            'jurusan' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:13', 'regex:/^[0-9]{10,13}$/'],
            'gender' => ['required', 'in:L,P'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Membuat dosen baru
        $dosen = Dosen::create([
            'name' => $request->name,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'no_hp' => $request->no_hp,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        // Memicu event registrasi
        event(new Registered($dosen));

        // Login otomatis setelah registrasi
        Auth::guard('dosen')->login($dosen);

        return redirect()->route('dosen.dashboard');
    }

    /**
     * Logout dosen.
     */
    public function destroy(Request $request)
    {
        Auth::guard('dosen')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
