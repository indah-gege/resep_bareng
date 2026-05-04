@extends('admin.layouts.sidebar')
@section('title', 'Kelola Resep')

@push('styles')
<style>
    .page-title { font-size:18px; font-weight:700; margin-bottom:20px; color:#222; }
    .toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; }
    .search-input { padding:8px 12px; border:1.5px solid #ddd; border-radius:6px; font-size:13px; width:200px; }
    .btn-tambah { background:#3a3a3a; color:white; padding:8px 16px; border:none; border-radius:6px; font-size:13px; text-decoration:none; }
    table { width:100%; border-collapse:collapse; background:white; border-radius:10px; overflow:hidden; }
    th { background:#f5f5f5; padding:10px 14px; text-align:left; font-size:12px; color:#666; font-weight:600; }
    td { padding:10px 14px; font-size:13px; border-top:1px solid #f0f0f0; }
    td img { width:40px; height:40px; border-radius:6px; object-fit:cover; }
    .btn-edit { background:#3a3a3a; color:white; padding:5px 14px; border:none; border-radius:4px; font-size:12px; text-decoration:none; }
    .btn-hapus { background:#e53e3e; color:white; padding:5px 14px; border:none; border-radius:4px; font-size:12px; cursor:pointer; }
</style>
@endpush

@section('content')
<div class="page-title">Kelola Resep</div>
<div class="toolbar">
    <form method="GET"><input class="search-input" type="text" name="q" placeholder="Cari resep..." value="{{ $query ?? '' }}"></form>
    <a href="{{ route('admin.resep.tambah') }}" class="btn-tambah">+ Tambah</a>
</div>
<table>
    <thead><tr><th>Foto</th><th>Judul</th><th>Kategori</th><th>Waktu</th><th>Aksi</th></tr></thead>
    <tbody>
        @forelse($reseps as $r)
        <tr>
            <td>@if($r->foto)<img src="{{ asset('storage/'.$r->foto) }}">@else<div style="width:40px;height:40px;background:#ddd;border-radius:6px"></div>@endif</td>
            <td>{{ $r->judul }}</td>
            <td>{{ $r->kategori->nama ?? '-' }}</td>
            <td>{{ $r->waktu_masak }} mnt</td>
            <td style="display:flex;gap:6px">
                <a href="{{ route('admin.resep.edit', $r->id) }}" class="btn-edit">Edit</a>
                <form method="POST" action="{{ route('admin.resep.hapus', $r->id) }}" onsubmit="return confirm('Hapus?')">
                    @csrf @method('DELETE')
                    <button class="btn-hapus">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;color:#aaa;padding:20px">Belum ada resep.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection