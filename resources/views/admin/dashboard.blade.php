@extends('admin.layouts.sidebar')
@section('title', 'Dashboard')

@push('styles')
<style>
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
    .page-header h2 { font-size: 18px; font-weight: 700; color: #4A071D; }
    .page-header p  { font-size: 12px; color: #A98467; }
    
    .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 28px; }
    .stat-card {
        background: #4A071D; border-radius: 10px; padding: 20px 16px;
        text-align: center; color: white; text-decoration: none; display: block;
    }
    .stat-card.special { background: #A98467; } /* Warna beda untuk fitur Superadmin */
    .stat-card .num { font-size: 28px; font-weight: 700; }
    .stat-card .label { font-size: 12px; color: #fdf5e6; margin-top: 4px; }
    
    .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
    .section-header h3 { font-size: 15px; font-weight: 700; color: #4A071D; }
    
    .search-row { display: flex; gap: 8px; }
    .search-row input {
        padding: 8px 12px; border: 1.5px solid #A98467; border-radius: 6px;
        font-size: 13px; outline: none; width: 200px; background: white;
    }
    
    .btn-tambah {
        background: #4A071D; color: white;
        padding: 8px 16px; border: none; border-radius: 6px;
        font-size: 13px; cursor: pointer; text-decoration: none;
        display: inline-flex; align-items: center; gap: 4px;
    }
    
    table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    th { background: #fdf2f2; padding: 12px 14px; text-align: left; font-size: 12px; color: #4A071D; font-weight: 600; }
    td { padding: 12px 14px; font-size: 13px; color: #333; border-top: 1px solid #f0f0f0; }
    
    .td-foto img { width: 40px; height: 40px; border-radius: 6px; object-fit: cover; }
    .td-foto .no-foto { width: 40px; height: 40px; border-radius: 6px; background: #ddd; }
    
    .btn-edit {
        background: #A98467; color: white; border: none;
        padding: 5px 14px; border-radius: 4px; font-size: 12px; cursor: pointer;
        text-decoration: none;
    }
    .btn-hapus {
        background: #e53e3e; color: white; border: none;
        padding: 5px 14px; border-radius: 4px; font-size: 12px; cursor: pointer;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h2>Dashboard</h2>
        <p>Ringkasan konten resep</p>
    </div>
    <a href="{{ route('admin.resep.tambah') }}" class="btn-tambah">+ Tambah Resep</a>
</div>

<div class="stats">
    <div class="stat-card">
        <div class="num">{{ $totalResep }}</div>
        <div class="label">Total resep</div>
    </div>
    <div class="stat-card">
        <div class="num">{{ $totalKategori }}</div>
        <div class="label">Total Kategori</div>
    </div>
    <div class="stat-card">
        <div class="num">{{ $totalUser }}</div>
        <div class="label">Total User</div>
    </div>
    <div class="stat-card">
        <div class="num">{{ $totalKomentar }}</div>
        <div class="label">Total Komentar</div>
    </div>

    {{-- KARTU KHUSUS SUPERADMIN --}}
    @if(auth()->user()->role === 'superadmin')
    <a href="{{ route('admin.reset.requests') }}" class="stat-card special">
        <div class="num">{{ $pendingResetCount ?? 0 }}</div>
        <div class="label">Persetujuan Reset</div>
    </a>
    @endif
</div>

<div class="section-header">
    <h3>Daftar Resep</h3>
    <div class="search-row">
        <form method="GET">
            <input type="text" name="q" placeholder="Cari resep..." value="{{ request('q') }}">
        </form>
        <a href="{{ route('admin.resep.tambah') }}" class="btn-tambah">+ Tambah</a>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Foto</th><th>Judul</th><th>Kategori</th><th>Waktu</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reseps as $r)
        <tr>
            <td class="td-foto">
                @if($r->foto)
                    <img src="{{ asset('storage/'.$r->foto) }}" alt="">
                @else
                    <div class="no-foto"></div>
                @endif
            </td>
            <td>{{ $r->judul }}</td>
            <td>{{ $r->kategori->nama ?? '-' }}</td>
            <td>{{ $r->waktu_masak }} mnt</td>
            <td style="display:flex;gap:6px;">
                <a href="{{ route('admin.resep.edit', $r->id) }}" class="btn-edit">Edit</a>
                <form method="POST" action="{{ route('admin.resep.hapus', $r->id) }}"
                      onsubmit="return confirm('Hapus resep ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-hapus">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;color:#aaa;padding:20px">Belum ada resep.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection