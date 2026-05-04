<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login User – ResepBareng</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #800020; }
        .login-card { background-color: #F3F4F6; border-radius: 30px; }
        .input-custom { background-color: #E5A9B4; border: 1.5px solid #800020; color: #800020; border-radius: 10px; }
        .input-custom::placeholder { color: #800020; opacity: 0.6; }
        .btn-round { border: 1.5px solid #800020; border-radius: 50px; transition: 0.3s; }
        .btn-round:hover { background: #800020; color: white; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md px-6 flex flex-col items-center">
        <div class="bg-black p-4 rounded-full mb-6 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
            </svg>
        </div>
        <div class="login-card p-10 shadow-2xl w-full">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-[#800020]">User ResepBareng</h2>
                <p class="text-[11px] text-gray-500 mt-1">Selamat Datang Kembali! Silahkan Login sebagai User</p>
            </div>

            @if (session('status'))
                <div class="mb-4 text-xs text-green-700 font-bold bg-green-100 p-3 rounded-lg text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.user.post') }}" autocomplete="off">
                @csrf
                <div class="mb-4 relative">
                    <input type="email" name="email" required autocomplete="off" class="input-custom w-full p-3 text-sm outline-none" placeholder="Masukkan Username/Email">
                    <span class="absolute right-3 top-3 text-[#800020]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                </div>
                <div class="mb-4 relative">
                    <input type="password" id="pass-user" name="password" required autocomplete="new-password" class="input-custom w-full p-3 text-sm outline-none" placeholder="Password">
                    <button type="button" onclick="togglePass('pass-user')" class="absolute right-3 top-3 text-[#800020]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                </div>
                <div class="flex items-center justify-between mb-8 text-xs">
                    <label class="flex items-center text-gray-700"><input type="checkbox" name="remember" class="mr-2"> Simpan Sandi</label>
                    <a href="{{ route('password.request') }}" class="text-[#800020] font-bold hover:underline">Lupa Sandi?</a>
                </div>
                <button type="submit" class="btn-round w-full py-2.5 font-bold text-gray-700 bg-white">Login</button>
                <div class="text-center mt-6 text-[11px] text-gray-500">
                    Belum Punya Akun? <a href="{{ route('register') }}" class="text-[#800020] font-bold">Daftar</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePass(inputId) {
            const p = document.getElementById(inputId);
            p.type = p.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>