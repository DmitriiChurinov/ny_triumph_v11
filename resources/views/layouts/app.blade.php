<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новогодний Блог 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #050505; color: #e5e5e5; font-family: 'Garamond', serif; overflow-x: hidden; }
        .gold-text { color: #d4af37; text-shadow: 0 0 10px #d4af37; }
        .gold-border { border-color: #d4af37; }
        .red-bg { background-color: #8b0000; }
        .card-bg { background-color: #0c0c0c; border: 1px solid #1a1a1a; }
        .snowflake { color: #fff; font-size: 1.2em; position: fixed; top: -10%; z-index: 9999; pointer-events: none; animation: fall linear infinite; }
        @keyframes fall { to { transform: translateY(110vh) rotate(360deg); } }
        .btn-action { background: linear-gradient(45deg, #8b0000, #d4af37); color: white; transition: 0.3s; }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(212,175,55,0.4); }
    </style>
</head>
<body>
    <script>
        function createSnowflake() {
            const f = document.createElement('div');
            f.innerHTML = '❄'; f.className = 'snowflake';
            f.style.left = Math.random() * 100 + 'vw';
            f.style.animationDuration = Math.random() * 3 + 2 + 's';
            f.style.opacity = Math.random();
            document.body.appendChild(f);
            setTimeout(() => f.remove(), 5000);
        }
        setInterval(createSnowflake, 150);
    </script>

    <nav class="p-6 border-b-2 gold-border red-bg shadow-2xl flex justify-between items-center sticky top-0 z-50">
        <a href="/" class="text-4xl font-black uppercase tracking-tighter gold-text">Блог 2025</a>
        <div class="flex items-center gap-6">
            <form action="/" method="GET" class="relative flex items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Искать подарки..." class="bg-black border-2 gold-border px-4 py-2 rounded-l-full text-sm outline-none text-yellow-500 w-64 focus:w-80 transition-all">
                <button type="submit" class="bg-black border-2 gold-border border-l-0 px-6 py-2 rounded-r-full text-xs font-bold gold-text uppercase hover:bg-yellow-900 transition">Искать</button>
            </form>
            @auth
                <a href="{{ route('articles.create') }}" class="font-bold hover:gold-text underline text-sm uppercase">Новый Пост</a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 group">
                    @if(auth()->user()->avatar) <img src="{{ asset('storage/'.auth()->user()->avatar) }}" class="w-10 h-10 rounded-full border-2 border-white"> @endif
                    <span class="font-bold text-xs uppercase group-hover:gold-text">{{ auth()->user()->name }}</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">@csrf <button class="text-xs opacity-50 uppercase hover:opacity-100">Выход</button></form>
            @else
                <a href="/login" class="uppercase text-sm font-bold hover:gold-text">Вход</a>
                <a href="/register" class="bg-white text-red-800 px-6 py-1 rounded-full font-black uppercase text-xs">Регистрация</a>
            @endauth
        </div>
    </nav>

    <div class="container mx-auto py-12 px-6">
        @if(session('status'))
            <div id="status-alert" class="bg-yellow-500 text-black p-4 mb-8 text-center font-bold rounded-lg border-2 border-red-800 flex justify-between items-center shadow-2xl">
                <span>{{ session('status') }}</span>
                <button onclick="document.getElementById('status-alert').remove()" class="text-2xl font-black px-2">&times;</button>
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html>
