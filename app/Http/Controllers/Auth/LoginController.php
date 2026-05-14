<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AdminResetRequest;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showUserLogin() { return view('auth.login'); }
    public function showAdminLogin() { return view('auth.login-admin'); } //Mnampilkn hlmn login admin

    public function loginUser(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required']);
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function loginAdmin(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required']); //required=wajib diisi
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) { //Auth::attemp:Mncoba mnccokkn email&pw ke db
            $user = Auth::user();
            if ($user->role !== 'admin' && $user->role !== 'superadmin') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun ini bukan akun admin.']);
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.user');
    }

    public function showForgotForm() { return view('auth.forgot-password'); }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.exists' => 'Email tidak terdaftar di sistem kami.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        AdminResetRequest::create([
            'email' => $request->email,
            'password_baru' => Hash::make($request->password),
            'status' => 'pending'
        ]);

        return back()->with('status', 'Permintaan terkirim! Silakan hubungi Superadmin untuk persetujuan.');
    }

    public function approveReset($id)
    {
        $req = AdminResetRequest::findOrFail($id);
        
        User::where('email', $req->email)->update([
            'password' => $req->password_baru
        ]);

        $req->update(['status' => 'disetujui']);

        return back()->with('success', 'Sandi admin berhasil diperbarui!');
    }

    public function rejectReset($id)
    {
        AdminResetRequest::findOrFail($id)->update(['status' => 'ditolak']);
        return back()->with('success', 'Permintaan reset ditolak.');
    }
}