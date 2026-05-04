<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resep->judul }} – ResepBareng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FDF5E6; color: #7A0C2E; }
        .text-maroon { color: #7A0C2E; }
        .bg-cream { background-color: #FDF5E6; }
        .main-container { max-width: 1000px; margin: 20px auto; padding: 20px; }
        .img-recipe { width: 100%; border-radius: 20px; object-fit: cover; aspect-ratio: 16/9; }
        .btn-time { background: #A98467; color: white; border-radius: 50px; padding: 5px 20px; font-weight: bold; }
        .avatar { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; }
    </style>
</head>
<body class="antialiased">

    <nav class="px-10 py-4 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-maroon">resep<span class="text-orange-500">bareng</span></a>
        <div class="flex gap-6 text-sm font-semibold">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <a href="{{ route('user.bookmark.index') }}">Bookmark</a>
        </div>
    </nav>

    <div class="main-container">
        <p class="text-xs text-maroon/60 mb-4">Beranda > {{ $resep->judul }}</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            {{-- Kolom Kiri: Gambar & Bahan --}}
            <div>
                <img src="{{ asset('storage/'.$resep->foto) }}" class="img-recipe mb-6 shadow-md">
                
                <h3 class="font-bold text-xl mb-4">Bahan-bahan:</h3>
                <ul class="space-y-1 text-sm">
                    @php 
                        $bahans = is_array($resep->bahan_bahan) ? $resep->bahan_bahan : explode("\n", $resep->bahan_bahan); 
                    @endphp

                    @foreach($bahans as $b)
                        @php
                            $namaBahan = is_array($b) ? ($b['nama'] ?? '') : $b;
                            $jumlahBahan = is_array($b) ? ($b['jumlah'] ?? '') : '';
                        @endphp

                        @if(!empty(trim(is_array($namaBahan) ? '' : $namaBahan)))
                        <li class="font-semibold text-orange-800">
                            {{ $namaBahan }} {{ $jumlahBahan ? '('.$jumlahBahan.')' : '' }}
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- Kolom Kanan: Judul, Deskripsi & Langkah --}}
            <div>
                <h1 class="text-3xl font-black mb-2">{{ $resep->judul }}</h1>
                <p class="text-xs leading-relaxed mb-4 text-maroon/80">{{ $resep->deskripsi_singkat }}</p>
                
                <div class="flex items-center gap-4 mb-4">
                    <span class="btn-time">⏱ {{ $resep->waktu_masak }} mnt</span>
                    <div class="text-orange-400 text-sm">★★★★☆ <span class="text-maroon/60 text-[10px]">Lihat Ulasan</span></div>
                </div>

                {{-- FITUR BOOKMARK: SUDAH BISA DIKLIK --}}
                <form action="{{ route('user.bookmark', $resep->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-xs font-bold mb-8 hover:text-orange-600 transition-all">
                        @php
                            $isBookmarked = auth()->user()->bookmarks()->where('resep_id', $resep->id)->exists();
                        @endphp
                        
                        @if($isBookmarked)
                            <span class="text-orange-600">🔖 Resep tersimpan di bookmark</span>
                        @else
                            <span class="text-maroon/70">🔖 Simpan resep ke bookmark</span>
                        @endif
                    </button>
                </form>

                <h3 class="font-bold text-xl mb-4">Langkah-langkah:</h3>
                <div class="space-y-4 text-xs leading-relaxed">
                    @php 
                        $langkahs = is_array($resep->langkah_langkah) ? $resep->langkah_langkah : explode("\n", $resep->langkah_langkah); 
                    @endphp

                    @foreach($langkahs as $i => $l)
                        @php
                            $teksLangkah = is_array($l) ? ($l['deskripsi'] ?? (string)$l) : $l;
                        @endphp

                        @if(!empty(trim(is_array($teksLangkah) ? '' : $teksLangkah)))
                        <div class="flex gap-2">
                            <span class="font-bold text-maroon">{{ $i+1 }}.</span>
                            <p class="text-gray-700">{{ $teksLangkah }}</p>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bagian Ulasan --}}
        <div class="mt-20 border-t border-maroon/10 pt-10">
            <h3 class="font-bold text-lg mb-8">Ulasan Teman Masak</h3>
            
            <div class="space-y-8">
                @forelse($resep->ulasans as $u)
                <div class="flex gap-4 p-4 bg-white/40 rounded-xl">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($u->user->name) }}&background=7A0C2E&color=fff" class="avatar shadow-sm">
                    
                    <div class="flex-grow">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-sm text-orange-800">{{ $u->user->name }}</h4>
                            <div class="text-orange-400 text-xs">
                                {{ str_repeat('★', $u->rating) }}{{ str_repeat('☆', 5 - $u->rating) }}
                                <span class="text-maroon/40 ml-2">{{ $u->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="text-xs text-maroon/80 mt-1 leading-relaxed">"{{ $u->komentar }}"</p>
                    </div>
                </div>
                @empty
                <p class="text-center italic text-maroon/40">Belum ada ulasan untuk resep ini.</p>
                @endforelse
            </div>

            @if(auth()->check() && !$sudahUlasan)
            <div class="mt-10 bg-gray-200/50 p-4 rounded-xl">
                <form method="POST" action="{{ route('user.ulasan.kirim', $resep->id) }}">
                    @csrf
                    <input type="text" name="komentar" required placeholder="Beri komentar dan rating" class="w-full bg-transparent border-none focus:outline-none text-xs italic">
                    <div class="flex justify-end items-center gap-4 mt-2">
                        <select name="rating" class="bg-transparent text-xs font-bold border-none outline-none">
                            <option value="5">★★★★★</option>
                            <option value="4">★★★★☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="1">★☆☆☆☆</option>
                        </select>
                        <button type="submit" class="text-maroon font-bold text-sm flex items-center gap-1 hover:text-orange-600">Kirim ➤</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</body>
</html>