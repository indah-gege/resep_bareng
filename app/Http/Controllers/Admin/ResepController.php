<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role === 'user') { abort(403); }
        $query  = $request->get('q');
        $reseps = Resep::with('kategori')->when($query, fn($q) => $q->where('judul', 'like', "%{$query}%"))->latest()->get();
        return view('admin.resep.index', compact('reseps', 'query'));
    }

    public function tambah()
    {
        if (auth()->user()->role === 'user') { abort(403); }
        $kategoris = Kategori::all();
        return view('admin.resep.tambah', compact('kategoris'));
    }

    public function simpan(Request $request)
    {
        if (auth()->user()->role === 'user') { abort(403); }
        $request->validate([
            'judul' => 'required', 
            'kategori_id' => 'required', 
            'foto' => 'nullable|image|max:2048',
        ]);

        $bahan = [];
        if ($request->bahan_nama) {
            foreach ($request->bahan_nama as $i => $nama) {
                if ($nama) {
                    $bahan[] = ['nama' => $nama, 'jumlah' => $request->bahan_jumlah[$i] ?? ''];
                }
            }
        }

        $fotoPath = $request->hasFile('foto') ? $request->file('foto')->store('resep', 'public') : null;

        Resep::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'waktu_masak' => (int) filter_var($request->waktu_masak, FILTER_SANITIZE_NUMBER_INT),
            'bahan_bahan' => $bahan,
            'langkah_langkah' => $request->langkah,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.resep.index')->with('success', 'Resep berhasil dibuat!');
    }

    public function edit($id)
    {
        if (auth()->user()->role === 'user') { abort(403); }
        $resep = Resep::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.resep.edit', compact('resep', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role === 'user') { abort(403); }
        
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $resep = Resep::findOrFail($id);
        
        $fotoPath = $resep->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath) Storage::disk('public')->delete($fotoPath);
            $fotoPath = $request->file('foto')->store('resep', 'public');
        }

        $bahan = [];
        if ($request->bahan_nama) {
            foreach ($request->bahan_nama as $i => $nama) {
                if ($nama) {
                    $bahan[] = ['nama' => $nama, 'jumlah' => $request->bahan_jumlah[$i] ?? ''];
                }
            }
        }

        $resep->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'waktu_masak' => (int) filter_var($request->waktu_masak, FILTER_SANITIZE_NUMBER_INT),
            'bahan_bahan' => $bahan,
            'langkah_langkah' => $request->langkah,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.resep.index')->with('success', 'Resep berhasil diupdate!');
    }

    public function hapus($id)
    {
        if (auth()->user()->role === 'user') { abort(403); }
        $resep = Resep::findOrFail($id);
        if ($resep->foto) Storage::disk('public')->delete($resep->foto);
        $resep->delete();
        return back()->with('success', 'Resep dihapus!');
    }
}