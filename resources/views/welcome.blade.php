<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ResepBareng - Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8C8D4; } /* Pink Background Figma */
        .text-maroon { color: #7A0C2E; }
        .bg-maroon { background-color: #7A0C2E; }
        .card-recipe { background-color: #2D3E33; border-radius: 30px; } /* Hijau Tua Card */
        .search-pill { border-radius: 50px; border: 1.5px solid #7A0C2E; }
        .cat-pill { border-radius: 50px; border: 1.5px solid #7A0C2E; color: #7A0C2E; font-weight: 600; }
        .cat-pill.active { background-color: #7A0C2E; color: white; }
    </style>
</head>
<body class="antialiased">

    <header class="p-6">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center font-bold text-green-800">RB</div>
                <h1 class="text-maroon font-bold text-2xl">resep<span class="text-green-800">bareng</span></h1>
            </div>
            
            <div class="flex-grow max-w-md mx-10 relative">
                <input type="text" class="w-full py-2 px-12 search-pill focus:outline-none bg-white/40" placeholder="cari resep disini...">
                <span class="absolute left-4 top-2.5">🔍</span>
            </div>

            <nav class="flex gap-8 text-maroon font-semibold">
                <a href="#" class="hover:underline">Beranda</a>
                <a href="#" class="hover:underline">Bookmark</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">Keluar</a>
                    @else
                        <a href="{{ route('login') }}">Masuk</a>
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-4 mt-4">
        <div class="bg-white/40 border-2 border-blue-300 rounded-3xl p-12 text-center relative">
            <p class="text-maroon font-bold text-sm mb-2 uppercase tracking-widest">Temukan Resep Favoritmu</p>
            <h2 class="text-4xl md:text-5xl font-black text-maroon leading-tight">
                Ratusan Resep Lezat dan Sehat yang Mudah<br>Untuk dicoba di Rumah
            </h2>
            <div class="absolute right-10 top-1/2 -translate-y-1/2 text-7xl opacity-30 hidden lg:block">🍳</div>
        </div>
    </div>

    <div class="container mx-auto mt-10 flex justify-center gap-4 px-4 overflow-x-auto">
        <button class="cat-pill active px-8 py-2 whitespace-nowrap">Makanan Berat</button>
        <button class="cat-pill px-8 py-2 whitespace-nowrap bg-white/20">Sarapan</button>
        <button class="cat-pill px-8 py-2 whitespace-nowrap bg-white/20">Camilan</button>
        <button class="cat-pill px-8 py-2 whitespace-nowrap bg-white/20">Minuman</button>
        <button class="cat-pill px-8 py-2 whitespace-nowrap bg-white/20">Dessert</button>
        <button class="px-6 py-2 text-maroon font-bold italic">Selengkapnya...</button>
    </div>

    <div class="container mx-auto mt-16 mb-24 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <div class="card-recipe p-8 shadow-2xl transform transition hover:scale-105">
                <div class="flex justify-center -mt-20 mb-6">
                    <img src="https://images.unsplash.com/photo-1512058560566-42724afbc2db?q=80&w=200&auto=format&fit=crop" 
                         class="w-40 h-40 rounded-full border-8 border-white shadow-xl object-cover">
                </div>
                <div class="bg-white inline-block px-4 py-1 rounded-full text-xs font-bold mb-4">Sarapan</div>
                <h3 class="text-white font-bold text-2xl">Nasi Goreng Kampung</h3>
                <div class="flex justify-between mt-6 text-white/90 text-sm border-t border-white/20 pt-4">
                    <span>🕒 30 menit</span>
                    <span>🍽️ 2 porsi</span>
                </div>
            </div>

            <div class="card-recipe p-8 shadow-2xl transform transition hover:scale-105">
                <div class="flex justify-center -mt-20 mb-6">
                    <img src="https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=200&auto=format&fit=crop" 
                         class="w-40 h-40 rounded-full border-8 border-white shadow-xl object-cover">
                </div>
                <div class="bg-white inline-block px-4 py-1 rounded-full text-xs font-bold mb-4">Minuman</div>
                <h3 class="text-white font-bold text-2xl">Matcha Latte</h3>
                <div class="flex justify-between mt-6 text-white/90 text-sm border-t border-white/20 pt-4">
                    <span>🕒 8 menit</span>
                    <span>🍽️ 1 porsi</span>
                </div>
            </div>

            <div class="card-recipe p-8 shadow-2xl transform transition hover:scale-105">
                <div class="flex justify-center -mt-20 mb-6">
                    <img src="https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=200&auto=format&fit=crop" 
                         class="w-40 h-40 rounded-full border-8 border-white shadow-xl object-cover">
                </div>
                <div class="bg-white inline-block px-4 py-1 rounded-full text-xs font-bold mb-4">Dessert</div>
                <h3 class="text-white font-bold text-2xl">Dessert Coklat</h3>
                <div class="flex justify-between mt-6 text-white/90 text-sm border-t border-white/20 pt-4">
                    <span>🕒 45 menit</span>
                    <span>🍽️ 1 porsi</span>
                </div>
            </div>

        </div>
    </div>

</body>
</html>