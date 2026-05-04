<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'user') { abort(403); }
        $ulasans = Ulasan::with(['user', 'resep'])->latest()->get();
        return view('admin.ulasan.index', compact('ulasans'));
    }
}