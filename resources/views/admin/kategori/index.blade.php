@extends('admin.layouts.sidebar')
@section('title', 'Kelola Kategori')

@push('styles')
<style>
    .page-title { font-size:18px; font-weight:700; margin-bottom:20px; color:#222; }
    .grid { display:grid; grid-template-columns:1fr 1fr; gap:24px; }
    .card { background:white; border-radius:10px; padding:24px; }
    .card h3 { font-size:15px; font-weight:700; margin-bottom:16px; }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:12px; color:#555; margin-bottom:4px; font-weight:600; }
    .form-group input { width:100%; padding:9px 12px; border:1.5px solid #ddd; border-radius:6px; font-size:13px; }
    .btn-tambah { width:100%; background:#e53e3e; color:white; border:none; padding:10px; border-radius:6px; font-size:14px; font-weight:600; cursor:pointer; }
    table { width:100%; border-collapse:collapse; }
    th { background:#f5f5f5; padding:10px 14px; text-align:left; font-size:12px; color:#666; }
    td { padding:10px 14px; font-size:13px; border-top:1px solid #f0f0f0; }
    .btn-hapus { background:#e53e3e; color:white; padding:5px 14px; border:none; border-radius:4px; font-size:12px; cursor:pointer; }
</style>
@endpush

@section('content')
<div class="page-title">Kelola Kategori</div>
<div class="grid">
    <div class="card">
        <h3>Tambah Kategori</h3>
        <form method="POST" action="{{ route('admin.kategori.simpan') }}">
            @csrf
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama" placeholder="Contoh: Lauk">
                @error('nama')<div style="color:#e53e3e;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-tambah">Tambah Kategori</button>
        </form>
    </div>
    <div class="card">
        <h3>Daftar Kategori</h3>
        <table>
            <thead><tr><th>NO</th><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($kategoris as $i => $k)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $k->nama }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.kategori.hapus', $k->id) }}" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;color:#aaa">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection