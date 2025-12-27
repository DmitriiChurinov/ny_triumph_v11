@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-10 text-xs uppercase font-black">
        <a href="/" class="gold-text border-b gold-border">← Назад к списку</a>
        @if(auth()->id() == $article->user_id)
            <div class="flex gap-4 underline">
                <a href="{{ route('articles.edit', $article->id) }}" class="text-blue-500">Править</a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Уничтожить навсегда?')">
                    @csrf @method('DELETE') <button class="text-red-500">Сжечь</button>
                </form>
            </div>
        @endif
    </div>

    <article class="card-bg p-12 rounded-3xl border-2 gold-border shadow-2xl relative">
        <div class="absolute -top-8 -right-8 text-7xl rotate-12">🎆</div>
        <h1 class="text-7xl font-black mb-10 gold-text leading-none">{{ $article->title }}</h1>
        <div class="text-2xl leading-relaxed mb-16 text-gray-200 whitespace-pre-line border-l-4 gold-border pl-6 italic">
            {{ $article->content }}
        </div>

        <div class="bg-black p-8 border-2 gold-border rounded-2xl flex justify-between items-center shadow-inner">
            <span class="text-2xl font-black gold-text uppercase">Магический Рейтинг: {{ $article->averageRating() }} / 5</span>
            @auth
            <form action="{{ route('rate') }}" method="POST" class="flex items-center gap-4">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <select name="value" class="bg-black border-2 gold-border text-yellow-500 font-black p-2 outline-none rounded">
                    @for($i=5; $i>=1; $i--) <option value="{{ $i }}">{{ $i }} ЗВЕЗД</option> @endfor
                </select>
                <button class="btn-action px-8 py-2 rounded font-black uppercase text-xs">Оценить</button>
            </form>
            @endauth
        </div>
    </article>

    <section class="mt-20">
        <h3 class="text-4xl font-black mb-12 gold-text italic uppercase tracking-tighter">Шёпот под ёлкой</h3>
        @auth
        <form action="{{ route('comment') }}" method="POST" class="mb-12 bg-black p-8 rounded-3xl border-2 gold-border shadow-2xl">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="body" required class="w-full bg-black border-b-2 gold-border p-4 text-white mb-6 outline-none text-xl focus:border-white transition-all" rows="3" placeholder="Ваше послание..."></textarea>
            <button class="btn-action px-12 py-4 rounded-full uppercase font-black tracking-widest">Оставить след</button>
        </form>
        @endauth

        <div class="space-y-10">
            @foreach($article->comments as $c)
            <div class="card-bg p-8 rounded-3xl border-l-8 border-red-800 shadow-xl">
                <div class="flex items-center gap-4 mb-4"><b class="gold-text uppercase text-sm font-black">{{ $c->user->name }}</b></div>
                <p class="text-xl leading-relaxed text-gray-300 italic">"{{ $c->body }}"</p>
                @auth
                <form action="{{ route('comment') }}" method="POST" class="mt-6 flex gap-4">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}"><input type="hidden" name="parent_id" value="{{ $c->id }}">
                    <input type="text" name="body" class="flex-1 bg-transparent border-b gold-border p-2 text-sm outline-none focus:border-white transition" placeholder="Ответить...">
                    <button class="gold-text font-black text-xs uppercase underline">Отправить</button>
                </form>
                @endauth
                @foreach($c->replies as $r)
                    <div class="ml-12 mt-6 p-4 bg-red-900/10 border-l border-yellow-600 italic text-sm italic opacity-70">
                        <span class="gold-text font-bold uppercase text-[10px]">{{ $r->user->name }}:</span> {{ $r->body }}
                    </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
