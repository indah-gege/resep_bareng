<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin – ResepBareng</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #A98467; }
        .login-card { background-color: #FDF5E6; border-radius: 30px; }
        .input-custom { 
            background-color: #FFFFFF; 
            border: 1.5px solid #4A071D; 
            color: #4A071D; 
            border-radius: 12px; 
            transition: 0.3s;
        }
        .input-custom:focus {
            border-color: #7A0C2E;
            outline: none;
            box-shadow: 0 0 0 3px rgba(122, 12, 46, 0.1);
        }
        .input-custom::placeholder { color: #4A071D; opacity: 0.5; } /*teks bantuan, misal tulisan "Masukkan Email..."*/    
        .btn-round { /*class utk membuat button yg bentukny lonjong/bulat di ujungnya*/
            background-color: #4A071D;
            color: #FDF5E6;
            border-radius: 50px; 
            transition: 0.3s; 
            border: none;
            cursor: pointer;
        }
        .btn-round:hover { background: #7A0C2E; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md px-6 flex flex-col items-center">
        <div class="bg-[#4A071D] p-4 rounded-full mb-6 shadow-lg">
            <svg class="w-10 h-10 text-[#FDF5E6]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"></path>
            </svg>
        </div>

        <div class="login-card p-10 shadow-2xl w-full">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-[#4A071D]">Admin ResepBareng</h2>
                <p class="text-[11px] text-gray-500 mt-1">Selamat Datang Kembali! Silahkan Login sebagai Admin</p>
            </div>
            
            <form method="POST" action="{{ route('login.admin.post') }}" autocomplete="off"> <!--Mnentukn data login akan dikirim ke fungsi loginAdmin di Controller melalui metode POST-->
                @csrf
               
                <div class="mb-4">
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           class="input-custom w-full p-3 text-sm outline-none" 
                           placeholder="Masukkan Username/Email">
                </div>

                <div class="mb-4">
                    <input type="password" id="pass-admin" name="password" required 
                           class="input-custom w-full p-3 text-sm outline-none" 
                           placeholder="Password" autocomplete="new-password">
                </div>

                <div class="flex items-center justify-between mb-8 text-xs">
                    <label class="flex items-center text-gray-700 font-medium cursor-pointer">
                        <input type="checkbox" name="remember" class="mr-2 accent-[#4A071D]"> 
                        Simpan Sandi
                    </label>
                    <a href="{{ route('password.request') }}" class="text-[#4A071D] font-bold hover:underline">Lupa Sandi?</a>
                </div>

                <button type="submit" class="btn-round w-full py-3 font-bold shadow-md">
                    Login Admin
                </button>
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