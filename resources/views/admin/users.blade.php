@extends('admin.layouts.sidebar')
@section('title', 'Kelola User')

@push('styles')
<style>
    .page-title { font-size:18px; font-weight:700; margin-bottom:20px; color:#222; }
    table { width:100%; border-collapse:collapse; background:white; border-radius:10px; overflow:hidden; }
    th { background:#f5f5f5; padding:10px 14px; text-align:left; font-size:12px; color:#666; font-weight:600; }
    td { padding:10px 14px; font-size:13px; border-top:1px solid #f0f0f0; }
    .badge { display:inline-block; padding:3px 10px; border-radius:12px; font-size:11px; font-weight:600; }
    .badge-admin { background:#fce8e8; color:#7b1a1a; }
    .badge-user { background:#e6f0ff; color:#185FA5; }
    .badge-superadmin { background:#f0e6fe; color:#6b21a8; }
</style>
@endpush

@section('content')
<div class="page-title">Kelola User</div>
<table>
    <thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Role</th></tr></thead>
    <tbody>
        @foreach($users as $i => $u)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>
                <span class="badge badge-{{ $u->role }}">{{ ucfirst($u->role) }}</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection