<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ResepBareng - Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FDF5E6; margin: 0; padding: 0; }
        .text-maroon { color: #7A0C2E; }
        .bg-maroon { background-color: #7A0C2E; }
        .bg-cream { background-color: #FDF5E6; }
        .bg-banner { background-color: #FFE4B5; border-radius: 20px; }
        
        .search-container { border: 1.5px solid #7A0C2E; border-radius: 50px; background: white; }
        
        .card-recipe { 
            background-color: #E2E2B6; 
            border-radius: 25px; 
            overflow: hidden;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .recipe-img {
            width: 100%;
            height: 150px; 
            object-fit: cover;
            border-radius: 20px;
        }
        .cat-pill { 
            border: 1px solid #7A0C2E; 
            border-radius: 50px; 
            color: #7A0C2E; 
            font-weight: 500; 
            padding: 5px 20px;
            transition: 0.3s;
            background: white;
            white-space: nowrap;
        }
        .cat-pill.active { background-color: #7A0C2E; color: white; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="antialiased">

    <header class="w-full px-10 py-4 bg-cream">
        <div class="container mx-auto flex items-center justify-between">
            
            <div class="flex flex-col items-center shrink-0">
                <img src="{{ asset('logo.png') }}" style="width: 140px; height: 140px;" class="object-contain" alt="Logo"> 
                <h1 class="text-maroon font-bold text-lg leading-none -mt-2">
                </h1>
            </div>

            <form action="{{ route('dashboard') }}" method="GET" class="flex-grow max-w-md mx-8">
                <div class="search-container flex items-center px-4 py-2">
                    <input type="text" name="q" value="{{ $query ?? '' }}" class="bg-transparent w-full focus:outline-none text-sm text-maroon placeholder-maroon/60" placeholder="cari resep disini...">
                    <span class="text-maroon"></span>
                </div>
            </form>

            <nav class="flex items-center gap-6 text-maroon font-semibold text-sm">
                <a href="{{ route('dashboard') }}" class="border-b-2 border-maroon pb-1">Beranda</a>
                <a href="{{ route('user.bookmark.index') }}" class="hover:text-orange-500 transition">Bookmark</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-maroon text-white px-5 py-2 rounded-full text-xs font-bold hover:bg-opacity-90 transition">Keluar</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-10 pb-20 mt-2">
        @if(!$kategoriId)
        <div class="bg-banner p-10 flex justify-between items-center relative mb-12 overflow-hidden rounded-[35px]">
            <div class="max-w-xl z-10">
                <p class="text-maroon font-bold text-xs uppercase mb-2 tracking-widest opacity-70">Temukan Resep Favoritmu</p>
                <h2 class="text-maroon font-black text-3xl leading-tight">
                    Ratusan Resep Lezat dan Sehat yang Mudah Untuk dicoba di Rumah
                </h2>
            </div>
            <img src="{{ asset('frypan.png') }}" class="w-48 h-48 absolute right-8 top-1/2 -translate-y-1/2 object-contain" alt="Frypan">
        </div>
        @else
        <div class="bg-banner p-10 flex justify-between items-center relative mb-12 overflow-hidden rounded-[35px]">
            <div class="max-w-2xl z-10">
                <p class="text-maroon font-medium text-sm mb-2 opacity-80">
                    Beranda <span class="mx-1">&lt;</span> Kategori <span class="mx-1">&lt;</span> {{ $kategoris->where('id', $kategoriId)->first()->nama ?? '' }}
                </p>
                <h2 class="text-maroon font-bold text-2xl leading-tight">
                    Temukan {{ strtolower($kategoris->where('id', $kategoriId)->first()->nama ?? '') }} apa saja yang menarik untuk kamu coba di rumah
                </h2>
            </div>
            <img src="{{ asset('frypan.png') }}" class="w-44 h-44 absolute right-10 top-1/2 -translate-y-1/2 object-contain" alt="Ilustrasi Kategori">
        </div>
        @endif

        <div class="flex gap-3 mb-10 overflow-x-auto no-scrollbar">
            @foreach($kategoris as $k)
                <a href="{{ route('dashboard', ['kategori'=>$k->id]) }}" class="cat-pill {{ $kategoriId == $k->id ? 'active' : '' }}">
                    {{ $k->nama }}
                </a>
            @endforeach
            <button class="text-maroon text-sm font-bold ml-2">Selengkapnya...</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($reseps as $r)
            <div class="h-full">
                <a href="{{ route('user.resep.detail', $r->id) }}" class="card-recipe p-5 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <img src="{{ $r->foto ? asset('storage/'.$r->foto) : 'https://via.placeholder.com/400' }}" class="recipe-img mb-4 shadow-sm" alt="{{ $r->judul }}">
                    
                    <div class="flex-grow">
                        <span class="text-[11px] font-bold text-orange-600 uppercase tracking-widest">{{ $r->kategori->nama ?? 'Resep' }}</span>
                        <h3 class="text-maroon font-bold text-xl leading-tight mt-1">{{ $r->judul }}</h3>
                    </div>
                    
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-maroon/10 text-xs text-maroon/80">
                        <span class="flex items-center gap-1 font-semibold text-black">🕒 {{ $r->waktu_masak }} menit</span>
                        <span class="text-orange-500 font-bold text-sm">★ {{ $r->rating ?? '4.5' }}</span>
                    </div>
                </a>
            </div>
            @empty
                <div class="col-span-full text-center py-20 text-maroon opacity-50">
                    Belum ada resep yang tersedia.
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>