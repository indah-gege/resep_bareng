<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use App\Models\Ulasan;
use App\Models\Kategori; // Tambahkan ini agar kategori terbaca
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    /**
     * Menampilkan Dashboard Utama untuk Bos Besar.
     */
    public function index(Request $request)
    {
        $query = $request->input('q');
        $kategoriId = $request->input('kategori'); // Ambil ID Kategori dari URL

        // Ambil semua kategori untuk ditampilkan di tombol-tombol atas (pills)
        $kategoris = Kategori::all();
        
        $reseps = Resep::with('kategori')
            ->when($query, function($q) use ($query) {
                return $q->where('judul', 'like', "%{$query}%")
                         ->orWhere('deskripsi_singkat', 'like', "%{$query}%");
            })
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->latest()
            ->get();

        // Pastikan $kategoriId, $kategoris, dan $query dikirim ke view agar tidak error
        return view('user.dashboard', compact('reseps', 'query', 'kategoris', 'kategoriId'));
    }

    /**
     * Menampilkan Detail Resep dengan Desain Figma yang Elegan.
     */
    public function detail($id)
    {
        $resep = Resep::with(['kategori', 'ulasans.user'])->findOrFail($id);
        
        $sudahUlasan = Ulasan::where('user_id', Auth::id())
                            ->where('resep_id', $id)
                            ->exists();

        return view('user.resep-detail', compact('resep', 'sudahUlasan'));
    }

    /**
     * Mengatur Fitur Simpan/Hapus Bookmark.
     */
    public function toggleBookmark($id)
    {
        Auth::user()->bookmarks()->toggle($id);
        return back();
    }

    /**
     * Menampilkan Daftar Resep yang Telah Bos Simpan.
     */
    public function bookmark()
    {
        $reseps = Auth::user()->bookmarks()->with('kategori')->get();
        return view('user.bookmark', compact('reseps'));
    }

    /**
     * Menyimpan Ulasan Berharga dari Bos.
     */
    public function kirimUlasan(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000'
        ]);

        Ulasan::create([
            'user_id' => Auth::id(),
            'resep_id' => $id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return back()->with('success', 'Hormat saya, ulasan Bos telah berhasil dipublikasikan!');
    }
}