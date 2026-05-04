@extends('admin.layouts.sidebar')
@section('title', 'Persetujuan Reset Sandi')

@section('content')
<div style="padding: 20px;">
    <h2 style="color: #4A071D; font-weight: 700; margin-bottom: 20px;">Persetujuan Reset Sandi Admin</h2>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <thead style="background: #fdf2f2;">
            <tr>
                <th style="padding: 15px; text-align: left; font-size: 13px; color: #4A071D;">Email Admin</th>
                <th style="padding: 15px; text-align: left; font-size: 13px; color: #4A071D;">Waktu</th>
                <th style="padding: 15px; text-align: left; font-size: 13px; color: #4A071D;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $req)
            <tr style="border-top: 1px solid #eee;">
                <td style="padding: 15px; font-size: 14px;">{{ $req->email }}</td>
                <td style="padding: 15px; font-size: 13px; color: #666;">{{ $req->created_at->diffForHumans() }}</td>
                <td style="padding: 15px; display: flex; gap: 8px;">
                    <form action="{{ route('admin.approve.reset', $req->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: #48bb78; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: 600;">Setujui</button>
                    </form>
                    <form action="{{ route('admin.reject.reset', $req->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: #e53e3e; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: 600;">Tolak</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center; padding: 40px; color: #aaa; font-style: italic;">Tidak ada permintaan reset sandi saat ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection