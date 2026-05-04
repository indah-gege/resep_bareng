<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permintaan Ganti Sandi – ResepBareng</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #A98467; }
        .login-card { background-color: #FDF5E6; border-radius: 30px; }
        .input-custom { 
            background-color: #FFFFFF; 
            border: 1.5px solid #D1D5DB; 
            color: #4A071D; 
            border-radius: 10px; 
        }
        .input-custom::placeholder { color: #4A071D; opacity: 0.5; }
        
        /* Tombol Utama: Maroon */
        .btn-primary { 
            background-color: #4A071D;
            color: white;
            border-radius: 50px; 
            transition: 0.3s; 
            border: none;
        }
        .btn-primary:hover { background: #7A0C2E; transform: translateY(-1px); }

        /* Tombol WhatsApp: Hijau */
        .btn-wa {
            background-color: #25D366;
            color: white;
            border-radius: 50px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-wa:hover { background: #128C7E; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md px-6 flex flex-col items-center">
        <div class="login-card p-10 shadow-2xl w-full border-t-8 border-[#4A071D]">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-[#4A071D]">Akses Terbatas</h2>
                <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-xl">
                    <p class="text-[11px] text-red-700 font-semibold italic">
                        Perhatian: Perubahan sandi Admin memerlukan verifikasi dan persetujuan dari Superadmin.
                    </p>
                </div>
            </div>

            <!-- Form kirim permintaan ke sistem (Superadmin Dashboard) -->
            <form method="POST" action="#" autocomplete="off">
                @csrf
                <div class="mb-4">
                    <label class="text-[11px] font-bold text-[#4A071D] ml-1">EMAIL ADMIN</label>
                    <input type="email" name="email" required class="input-custom w-full p-3 text-sm outline-none mt-1" placeholder="Masukkan Email Anda">
                </div>
                <div class="mb-6">
                    <label class="text-[11px] font-bold text-[#4A071D] ml-1">ALASAN RESET</label>
                    <textarea name="reason" rows="2" class="input-custom w-full p-3 text-sm outline-none mt-1" placeholder="Contoh: Lupa sandi lama..."></textarea>
                </div>

                <button type="submit" class="btn-primary w-full py-3 font-bold shadow-md mb-4">
                    Kirim Permintaan ke Superadmin
                </button>
            </form>

            <div class="relative flex py-3 items-center">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-400 text-[10px] uppercase font-bold">Atau Lapor Cepat</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Tombol WA buat lapor langsung ke Superadmin -->
            <a href="https://wa.me/628123456789?text=Halo%20Superadmin,%20saya%20ingin%20meminta%20persetujuan%20reset%20sandi%20Admin." 
               target="_blank" class="btn-wa w-full py-3 font-bold shadow-md mt-2">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                Chat Superadmin
            </a>

            <div class="text-center mt-6">
                <a href="{{ route('login.admin') }}" class="text-[#4A071D] text-xs font-bold hover:underline">← Kembali ke Login</a>
            </div>
        </div>
    </div>
</body>
</html>