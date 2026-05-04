<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'user') { abort(403); }
        $kategoris = Kategori::withCount('reseps')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function simpan(Request $request)
    {
        if (auth()->user()->role === 'user') { abort(403); }
        $request->validate(['nama' => 'required|string|max:100|unique:kategoris,nama']);
        Kategori::create(['nama' => $request->nama]);
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function hapus($id)
    {
        if (auth()->user()->role === 'user') { abort(403); }
        Kategori::findOrFail($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}