<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; //Mengambil Base Controller (induk Controller) bawaan Laravel
use App\Models\Resep;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Ulasan;
use App\Models\AdminResetRequest; 

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'user') { abort(403); } //utk mnjga halaman tsb hanya bisa dibuka Admin&menendang siapa pun yg mencoba masuk menggunakan akun "User" biasa

        $totalResep    = Resep::count(); //Resep itu dari models, ::count()->utk mnghitung brp bnyk baris(data) yg trsimpan didlm tabel resep
        $totalKategori = Kategori::count();
        $totalUser     = User::where('role', 'user')->count();
        $totalKomentar = Ulasan::count();
        $reseps        = Resep::with('kategori')->latest()->get(); //latest()=agar resep yg bru saja diinput muncul paling atas

        // Hitung permintaan reset yang belum diproses (untuk badge notifikasi)
        $pendingResetCount = AdminResetRequest::where('status', 'pending')->count(); //where('status', 'pending')=Sistem hnya mncari data yg kolom statusny bernilai 'pending'

        return view('admin.dashboard', compact('totalResep', 'totalKategori', 'totalUser', 'totalKomentar', 'reseps', 'pendingResetCount'));
        //compact=mengambil variabel" yg sdah dibuat sbelumny ($totalResep, $totalUser, dll) & "membungkusnya" jdi satu paket utk dikirim ke halaman view
    }

    public function users()
    {
        // Proteksi: Hanya Superadmin yang boleh lihat daftar user
        if (auth()->user()->role !== 'superadmin') {
            abort(403, 'Hanya Super Admin yang bisa mengakses halaman ini.');
        }

        $users = User::orderBy('id')->get();
        return view('admin.users', compact('users'));
    }

    // Fungsi menampilkan halaman kelola reset password (Khusus Superadmin)
    public function resetRequests()
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        $requests = AdminResetRequest::where('status', 'pending')->latest()->get();
        return view('admin.reset-requests', compact('requests'));
    }
}