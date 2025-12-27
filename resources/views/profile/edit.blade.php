@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto card-bg p-12 rounded-3xl border-4 gold-border shadow-2xl relative">
    <div class="mb-8 text-left uppercase font-black text-xs"><a href="/" class="gold-text border-b gold-border">← Назад</a></div>
    <h1 class="text-5xl font-black mb-12 gold-text uppercase text-center italic tracking-tighter">Ваш Лик</h1>
    
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 text-black">
        @csrf
        <div class="flex flex-col items-center mb-8">
            @if($user->avatar) <img src="{{ asset('storage/'.$user->avatar) }}" class="w-40 h-40 rounded-full border-4 gold-border shadow-2xl mb-4 transform hover:scale-110 transition"> @endif
            <input type="file" name="avatar" class="text-xs text-white">
        </div>

        <div class="space-y-6">
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border-2 p-4 rounded-xl outline-none font-bold">
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border-2 p-4 rounded-xl outline-none font-bold">
            <div class="grid grid-cols-2 gap-4">
                <input type="password" name="password" placeholder="Пароль" class="border-2 p-4 rounded-xl text-sm outline-none">
                <input type="password" name="password_confirmation" placeholder="Повтор" class="border-2 p-4 rounded-xl text-sm outline-none">
            </div>
        </div>

        <button class="btn-action w-full py-5 rounded-2xl text-2xl font-black uppercase text-white shadow-2xl tracking-widest">Обновить</button>
    </form>
</div>
@endsection
