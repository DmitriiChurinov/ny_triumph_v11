@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto card-bg p-12 rounded-3xl border-4 gold-border shadow-2xl">
    <div class="mb-8 text-left uppercase font-black text-xs"><a href="{{ route('articles.show', $article->id) }}" class="gold-text border-b gold-border">← Назад</a></div>
    <h2 class="text-6xl font-black mb-10 gold-text uppercase text-center italic tracking-tighter">Правка Послания</h2>
    <form action="{{ route('articles.update', $article->id) }}" method="POST" class="space-y-8">
        @csrf @method('PUT')
        <input type="text" name="title" value="{{ $article->title }}" class="w-full bg-black border-2 gold-border p-6 rounded-xl text-white font-black text-4xl outline-none focus:border-white">
        <textarea name="content" rows="12" class="w-full bg-black border-2 gold-border p-8 rounded-xl text-white outline-none text-xl focus:border-white">{{ $article->content }}</textarea>
        <button class="btn-action w-full py-6 rounded-2xl text-3xl font-black uppercase tracking-tighter">Сохранить</button>
    </form>
</div>
@endsection
