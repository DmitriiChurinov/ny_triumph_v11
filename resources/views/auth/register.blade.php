@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto card-bg p-12 rounded-3xl border-2 gold-border shadow-2xl text-center">
    <div class="mb-6 text-left uppercase font-black text-xs"><a href="/" class="gold-text border-b gold-border">← Назад</a></div>
    <h2 class="text-4xl font-black mb-10 gold-text uppercase italic tracking-tighter text-center tracking-widest">Стать эльфом</h2>
    <form action="/register" method="POST" enctype="multipart/form-data" class="space-y-6 text-black font-bold">
        @csrf
        <input type="text" name="name" required placeholder="ИМЯ" class="w-full p-4 rounded-xl outline-none bg-white border-4 border-red-950">
        <input type="email" name="email" required placeholder="EMAIL" class="w-full p-4 rounded-xl outline-none bg-white border-4 border-red-950">
        <input type="password" name="password" required placeholder="ПАРОЛЬ" class="w-full p-4 rounded-xl outline-none bg-white border-4 border-red-950">
        <input type="password" name="password_confirmation" required placeholder="ПОВТОР" class="w-full p-4 rounded-xl outline-none bg-white border-4 border-red-950">
        <div class="text-left text-xs text-white uppercase font-black"><label>Лик (Аватар):</label><input type="file" name="avatar" class="mt-2 font-bold"></div>
        <button class="btn-action w-full py-4 rounded-xl text-xl font-black uppercase text-white tracking-widest">Присягнуть</button>
    </form>
</div>
@endsection
