@extends('admin.layouts.sidebar')
@section('title', 'Ulasan')

@push('styles')
<style>
    .page-title { font-size:18px; font-weight:700; margin-bottom:20px; color:#222; }
    table { width:100%; border-collapse:collapse; background:white; border-radius:10px; overflow:hidden; }
    th { background:#f5f5f5; padding:10px 14px; text-align:left; font-size:12px; color:#666; font-weight:600; }
    td { padding:12px 14px; font-size:13px; border-top:1px solid #f0f0f0; vertical-align:top; }
    .stars { color:#f6ad55; font-size:15px; letter-spacing:1px; }
    .stars .empty { color:#ddd; }
    .komentar-text { color:#555; font-size:12px; margin-top:4px; }
    .badge {
        display:inline-block; padding:3px 10px; border-radius:12px;
        font-size:11px; font-weight:600;
    }
    .badge-user { background:#e6f0ff; color:#185FA5; }
</style>
@endpush

@section('content')
<div class="page-title">Ulasan</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Resep</th>
            <th>Rating</th>
            <th>Komentar</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($ulasans as $i => $u)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>
                <strong>{{ $u->user->name ?? '-' }}</strong><br>
                <span class="badge badge-user">{{ $u->user->role ?? 'user' }}</span>
            </td>
            <td>{{ $u->resep->judul ?? '-' }}</td>
            <td>
                <div class="stars">
                    @for($s = 1; $s <= 5; $s++)
                        @if($s <= $u->rating)&#9733;@else<span class="empty">&#9733;</span>@endif
                    @endfor
                </div>
                <small style="color:#aaa">{{ $u->rating }}/5</small>
            </td>
            <td><div class="komentar-text">{{ $u->komentar }}</div></td>
            <td style="white-space:nowrap;color:#aaa;font-size:12px">{{ $u->created_at->format('d M Y') }}</td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:#aaa;padding:24px">Belum ada ulasan.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection