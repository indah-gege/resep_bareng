<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login – ResepBareng</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #A98467; }
        .login-card { background-color: #FDF5E6; border-radius: 20px; }
        .input-custom {
            background-color: #FFFFFF;
            border: 1px solid #D1D5DB;
            color: #7A0C2E;
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.8rem;
        }
        .input-custom:focus { outline: none; border-color: #7A0C2E; ring: 2px; ring-color: #7A0C2E; }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md px-6">
        <div class="flex justify-center mb-6">
            <div class="bg-[#7A0C2E] p-4 rounded-full shadow-lg">
                <svg class="w-12 h-12 text-[#FDF5E6]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>

        <div class="login-card p-8 shadow-2xl">
            <h2 class="text-2xl font-bold text-center text-[#7A0C2E] mb-2">User Login</h2>
            <p class="text-[10px] text-center text-gray-500 mb-8">Masuk untuk menjelajahi resep lezat</p>

            @if ($errors->any())
                <div class="mb-4 text-xs text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.user.post') }}">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                           class="input-custom text-sm" placeholder="Email">
                </div>
                <div class="mb-4">
                    <input type="password" name="password" required 
                           class="input-custom text-sm" placeholder="Password">
                </div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded text-[#7A0C2E]">
                        <label for="remember_me" class="ml-2 text-[10px] text-[#7A0C2E]/70 font-semibold">Ingat Saya</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-[10px] text-[#7A0C2E] hover:underline">Lupa Sandi?</a>
                </div>
                <button type="submit" class="w-full bg-[#7A0C2E] text-white font-bold py-3 rounded-xl hover:bg-[#5a0922] transition shadow-md">
                    Login
                </button>
                <div class="mt-6 text-center">
                    <p class="text-[11px] text-gray-500">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-[#7A0C2E] font-bold hover:underline">Daftar Sekarang</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>