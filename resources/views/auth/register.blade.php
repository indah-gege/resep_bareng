<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar – ResepBareng</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #A98467; }
        .register-card { background-color: #FDF5E6; border-radius: 30px; }
        .input-custom {
            background-color: #FFFFFF;
            border: 1.5px solid #D1D5DB;
            color: #7A0C2E;
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            outline: none;
        }
        .input-custom:focus { border-color: #7A0C2E; }
        .input-custom::placeholder { color: #7A0C2E; opacity: 0.5; }
        .btn-round {
            border: 1.5px solid #7A0C2E;
            background-color: white;
            color: #7A0C2E;
            font-weight: 600;
            border-radius: 50px;
            padding: 0.6rem;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-round:hover { background-color: #7A0C2E; color: white; }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen py-10">
    <div class="w-full max-w-md px-6 flex flex-col items-center">
        <div class="bg-[#7A0C2E] p-4 rounded-full mb-6 shadow-lg">
            <svg class="w-10 h-10 text-[#FDF5E6]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
            </svg>
        </div>

        <div class="register-card p-10 shadow-2xl w-full">
            <h2 class="text-2xl font-bold text-center text-[#7A0C2E] mb-8">Daftar Akun Baru</h2>

            @if ($errors->any())
                <div class="mb-4 text-xs text-red-600 bg-red-50 p-3 rounded-lg border border-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf
                <div class="mb-4">
                    <label class="block text-[10px] text-gray-500 mb-1 ml-1 font-bold">NAMA LENGKAP</label>
                    <input type="text" name="name" required autofocus class="input-custom text-sm" placeholder="Masukkan Nama">
                </div>
                <div class="mb-4">
                    <label class="block text-[10px] text-gray-500 mb-1 ml-1 font-bold">EMAIL</label>
                    <input type="email" name="email" required class="input-custom text-sm" placeholder="Masukkan Email">
                </div>
                <div class="mb-4">
                    <label class="block text-[10px] text-gray-500 mb-1 ml-1 font-bold">PASSWORD</label>
                    <div class="relative">
                        <input type="password" id="reg-pass" name="password" required class="input-custom text-sm" placeholder="Password" autocomplete="new-password">
                        <button type="button" onclick="toggleView('reg-pass')" class="absolute right-3 top-3 text-[#7A0C2E]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mb-8">
                    <label class="block text-[10px] text-gray-500 mb-1 ml-1 font-bold">KONFIRMASI PASSWORD</label>
                    <div class="relative">
                        <input type="password" id="reg-confirm" name="password_confirmation" required class="input-custom text-sm" placeholder="Ulangi Password">
                        <button type="button" onclick="toggleView('reg-confirm')" class="absolute right-3 top-3 text-[#7A0C2E]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-4">
                    <button type="submit" class="btn-round shadow-sm">Daftar Sekarang</button>
                </div>
                <div class="text-center mt-6">
                    <p class="text-[11px] text-gray-500 font-medium">
                        Sudah Punya Akun? <a href="{{ route('login.user') }}" class="text-[#7A0C2E] font-bold hover:underline">Login Disini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <script>
        function toggleView(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>