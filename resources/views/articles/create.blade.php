@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto card-bg p-12 rounded-3xl border-4 gold-border shadow-2xl">
    <div class="mb-8 text-left uppercase font-black text-xs"><a href="/" class="gold-text border-b gold-border">← Назад</a></div>
    <h2 class="text-6xl font-black mb-10 gold-text uppercase text-center italic tracking-tighter">Новая Летопись 2025</h2>
    <form action="{{ route('articles.store') }}" method="POST" class="space-y-8">
        @csrf
        <input type="text" name="title" required placeholder="Заголовок..." class="w-full bg-black border-b-4 gold-border p-6 rounded-t-2xl text-white font-black text-4xl outline-none focus:border-white transition-all">
        <textarea name="content" rows="12" required placeholder="Летопись..." class="w-full bg-black border-2 gold-border p-8 rounded-b-2xl text-white outline-none text-xl focus:ring-4 focus:ring-red-900 transition-all"></textarea>
        <button class="btn-action w-full py-5 rounded-2xl text-3xl font-black uppercase tracking-widest shadow-xl">Опубликовать</button>
    </form>
</div>
@endsection
