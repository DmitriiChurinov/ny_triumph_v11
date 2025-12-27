@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto card-bg p-12 rounded-3xl border-2 gold-border shadow-2xl text-center">
    <div class="mb-6 text-left uppercase font-black text-xs"><a href="/" class="gold-text border-b gold-border">← Назад</a></div>
    <h2 class="text-4xl font-black mb-10 gold-text uppercase italic tracking-tighter">Вход</h2>
    <form action="/login" method="POST" class="space-y-6 text-black font-bold">
        @csrf
        <input type="email" name="email" required placeholder="EMAIL" class="w-full p-4 border-4 border-red-950 bg-white">
        <input type="password" name="password" required placeholder="ПАРОЛЬ" class="w-full p-4 border-4 border-red-950 bg-white">
        <button class="btn-action w-full py-4 rounded-xl text-xl font-black uppercase text-white tracking-widest">Войти</button>
    </form>
</div>
@endsection
