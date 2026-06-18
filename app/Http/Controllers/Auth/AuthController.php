<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            return $this->redirectBasedOnRole($user);
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password yang dimasukkan salah.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:20', 'unique:users,npm'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'program_studi' => ['required', 'string'],
            'angkatan' => ['required', 'integer', 'min:2000', 'max:' . date('Y')],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'nomor_hp' => ['nullable', 'string', 'max:15'],
            'role' => ['required', 'in:calon_aslab'],
            'terms' => ['accepted'],
        ], [
            'npm.unique' => 'NPM sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'terms.accepted' => 'Anda harus menyetujui syarat & ketentuan.',
            'role.in' => 'Role tidak valid.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'nama' => $request->nama,
                'npm' => $request->npm,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'program_studi' => $request->program_studi,
                'angkatan' => $request->angkatan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nomor_hp' => $request->nomor_hp,
                'role' => 'calon_aslab',
                'status' => true,
            ]);

            Auth::login($user);

            return redirect()->route('calonaslab.dashboard')
                ->with('success', 'Pendaftaran berhasil! Selamat datang di SIMASLAB.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.')
                ->withInput();
        }
    }

  
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('success', 'Anda berhasil logout.');
    }

    protected function redirectBasedOnRole($user)
    {
        $redirects = [
            'kepala_lab' => route('kepalalab.dashboard'),
            'penguji' => route('penguji.dashboard'),
            'calon_aslab' => route('calonaslab.dashboard'),
        ];

        if (isset($redirects[$user->role])) {
            return redirect()->intended($redirects[$user->role]);
        }

        return redirect()->route('login')
            ->with('error', 'Role tidak dikenali. Silakan hubungi administrator.');
    }
}