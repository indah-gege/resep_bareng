<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Sandi Admin – ResepBareng</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #A98467; }
        .login-card { background-color: #FDF5E6; border-radius: 30px; }
        .input-custom { 
            background: white; 
            border: 1px solid #D1D5DB; 
            border-radius: 12px; 
            padding: 12px 16px; 
            width: 100%; 
            outline: none; 
            font-size: 14px;
        }
        .input-custom:focus { border-color: #4A071D; ring: 1px; ring-color: #4A071D; }
        .btn-maroon { 
            background-color: #4A071D; 
            color: #FDF5E6; 
            border-radius: 50px; 
            transition: 0.3s; 
            width: 100%;
            padding: 14px;
            font-weight: bold;
        }
        .btn-maroon:hover { background: #7A0C2E; transform: translateY(-1px); }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen"> <!--flex=mngaktifkn flexbox, min-h-screen memaksa body utk memiliki tinggi minimal setinggi layar HP atau monitor si pengguna-->
    <div class="w-full max-w-md px-6">
        <div class="login-card p-10 shadow-2xl w-full border-t-8 border-[#4A071D]">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-[#4A071D]">Reset Sandi Admin</h2>
                <p class="text-[11px] text-gray-500 mt-1">Masukkan detail sandi baru Anda di bawah ini.</p>
            </div>

            <!-- Pesan Sukses -->
            @if(session('status'))
                <div class="mb-4 p-3 bg-green-100 border border-green-200 text-green-700 text-[12px] rounded-xl text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form Reset -->
            <form method="POST" action="{{ route('password.update') }}"> <!--action=... -> adlh tujuan/alamat kemna data form ini akan dikirim-->
                @csrf
                <div class="space-y-4">
                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" required class="input-custom" placeholder="Email Admin"> <!--old()=email yg uda diktik tdk akn trhps, class="input-custom"=mnghbungkn elemen kedesain CSS yg dibuat-->
                        @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <input type="password" name="password" required class="input-custom" placeholder="Sandi Baru">
                        @error('password') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <input type="password" name="password_confirmation" required class="input-custom" placeholder="Ulangi Sandi Baru">
                    </div>
                </div>

                <!--meminta persetujuan ke superadmin-->
                <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-2xl">
                    <p class="text-[11px] text-amber-800 leading-relaxed text-center">
                        <strong>Sistem Approval:</strong> Setelah klik tombol di bawah, permintaan Anda akan dikirim ke <strong>Superadmin</strong>. Sandi Anda baru akan berubah setelah disetujui di Dashboard Superadmin.
                    </p>
                </div>

                <button type="submit" class="btn-maroon mt-6 shadow-md">
                    Minta Persetujuan Superadmin
                </button>
            </form>

            <div class="text-center mt-8 pt-4 border-t border-gray-100">
                <a href="{{ route('login.admin') }}" class="text-[#4A071D] text-xs font-bold hover:underline italic">
                    ← Kembali ke Login Admin
                </a>
            </div>
        </div>
    </div>
</body>
</html>