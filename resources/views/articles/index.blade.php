@extends('layouts.app')
@section('content')
    <div class="text-center mb-16">
        @if($query)
            <h1 class="text-5xl font-black mb-4 uppercase">Найдено в снегу: <span class="gold-text italic">"{{ $query }}"</span></h1>
            <a href="/" class="text-red-500 font-bold underline uppercase text-xs">← Сбросить</a>
        @else
            <h1 class="text-8xl font-black gold-text italic tracking-tighter uppercase mb-4 animate-pulse">Новогодний Триумф</h1>
            <p class="text-xl text-gray-500 uppercase tracking-widest italic">Летопись событий 2025 года</p>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($articles as $a)
        <div class="card-bg p-8 rounded-3xl border-t-8 border-red-800 shadow-2xl hover:scale-105 transition-all group">
            <h2 class="text-3xl font-bold mb-4 group-hover:gold-text transition h-20 line-clamp-2">{{ $a->title }}</h2>
            <div class="flex justify-between text-[10px] text-gray-500 mb-6 font-bold uppercase tracking-widest border-b gold-border pb-2">
                <span>⭐ {{ $a->averageRating() }} / 5</span>
                <span>👤 {{ $a->user->name }}</span>
            </div>
            <p class="text-gray-400 mb-8 leading-relaxed h-18 line-clamp-3 italic">"{{ Str::limit($a->content, 120) }}"</p>
            <a href="{{ route('articles.show', $a->id) }}" class="btn-action w-full text-center py-3 rounded-xl uppercase text-xs font-black block shadow-lg">Прочесть</a>
        </div>
        @empty
            <div class="col-span-full text-center py-20 opacity-40">
                <span class="text-9xl block mb-4">❄</span>
                <p class="text-4xl font-bold italic">Записи не найдены...</p>
            </div>
        @endforelse
    </div>
    <div class="mt-16 text-yellow-500">{{ $articles->appends(['search' => $query])->links() }}</div>
@endsection
