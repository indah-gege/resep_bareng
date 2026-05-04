<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookmark Saya - ResepBareng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FDF5E6; }
        .text-maroon { color: #7A0C2E; }
        .card-bookmark { background-color: #E2E2B6; border-radius: 20px; overflow: hidden; padding: 12px; }
        .recipe-img { width: 100%; height: 140px; object-fit: cover; border-radius: 15px; }
    </style>
</head>
<body class="antialiased">

    <header class="w-full px-10 py-4 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-maroon">resep<span class="text-orange-500">bareng</span></a>
        <div class="flex items-center gap-6 text-sm font-semibold text-maroon">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <a href="{{ route('user.bookmark.index') }}" class="border-b-2 border-maroon">Bookmark</a>
        </div>
    </header>

    <main class="container mx-auto px-10 pt-10">
        <p class="text-xs text-maroon/60 mb-4">Beranda > Bookmark</p>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse($reseps as $r)
            <a href="{{ route('user.resep.detail', $r->id) }}" class="card-bookmark block hover:shadow-md transition">
                <img src="{{ $r->foto ? asset('storage/'.$r->foto) : 'https://via.placeholder.com/300' }}" class="recipe-img mb-3">
                <h3 class="text-maroon font-bold text-xs truncate">{{ $r->judul }}</h3>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-[10px] text-maroon/70 font-semibold">🕒 {{ $r->waktu_masak }} menit</span>
                    <span class="text-orange-500 text-[10px] font-bold">★ 4.9</span>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-20 text-maroon opacity-40">Belum ada resep yang disimpan.</div>
            @endforelse
        </div>
    </main>
</body>
</html>