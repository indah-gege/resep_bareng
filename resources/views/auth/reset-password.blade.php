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
        .login-card { background-color: #FDF5E6; border-radius: 40px; }
        
        .input-custom { 
            background-color: #EBF2FF; 
            border: 1px solid #D1E3FF; 
            color: #1A1A1A; 
            border-radius: 15px; 
        }
        .input-custom::placeholder { color: #6B7280; opacity: 0.7; }
        
        /* Tombol utama Maroon Gelap */
        .btn-primary { 
            background-color: #4A071D;
            color: white;
            border-radius: 50px; 
            transition: 0.3s; 
        }
        .btn-primary:hover { background: #360515; transform: scale(1.01); }

        /* Box Sistem Approval Kuning Lembut */
        .approval-box {
            background-color: #FFFBEB;
            border: 1px solid #FEF3C7;
            border-radius: 20px;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md">
        <div class="login-card p-10 shadow-2xl w-full border-t-[12px] border-[#4A071D]">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-[#4A071D]">Reset Sandi Admin</h2>
                <p class="text-sm text-gray-500 mt-2 font-medium">Masukkan detail sandi baru Anda di bawah ini.</p>
            </div>

            <!-- Form Reset Sandi (Hanya ke Sistem) -->
            <form method="POST" action="{{ route('password.update') }}" autocomplete="off">
                @csrf
                
                <div class="mb-4">
                    <input type="email" name="email" required 
                        class="input-custom w-full p-4 text-md outline-none" 
                        placeholder="admin@gmail.com" value="{{ old('email') }}">
                </div>

                <div class="mb-4">
                    <input type="password" name="password" required 
                        class="input-custom w-full p-4 text-md outline-none" 
                        placeholder="••••••••">
                </div>

                <div class="mb-6">
                    <input type="password" name="password_confirmation" required 
                        class="input-custom w-full p-4 text-md outline-none bg-white border-gray-200" 
                        placeholder="Ulangi Sandi Baru">
                </div>

                <div class="approval-box p-5 mb-8">
                    <p class="text-[13px] text-center leading-relaxed">
                        <span class="font-bold text-[#92400E]">Sistem Approval:</span> 
                        <span class="text-gray-600">Setelah klik tombol di bawah, permintaan Anda akan dikirim ke </span>
                        <span class="font-bold text-[#92400E]">Superadmin.</span> 
                        <span class="text-gray-600">Sandi Anda baru akan berubah setelah disetujui di Dashboard Superadmin.</span>
                    </p>
                </div>

                <button type="submit" class="btn-primary w-full py-4 text-lg font-bold shadow-lg mb-6">
                    Minta Persetujuan Superadmin
                </button>
            </form>

            <div class="text-center">
                <a href="{{ route('login.admin') }}" class="text-[#4A071D] text-sm font-bold hover:underline">
                    ← Kembali ke Login Admin
                </a>
            </div>
        </div>
    </div>
</body>
</html>