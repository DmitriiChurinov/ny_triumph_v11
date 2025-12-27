<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller {
    public function index(Request $request) {
        $query = $request->input('search');
        
        $articles = Article::with('user', 'ratings')
            ->when($query, function ($q) use ($query) {
                $lowQuery = mb_strtolower($query, 'UTF-8');
                return $q->where('search_title', 'LIKE', "%{$lowQuery}%");
            })
            ->latest()->paginate(6);

        return view('articles.index', compact('articles', 'query'));
    }

    public function show(Article $article) {
        $article->load(['user', 'comments.user', 'comments.replies.user', 'ratings']);
        return view('articles.show', compact('article'));
    }

    public function create() { return view('articles.create'); }

    public function store(Request $request) {
        $v = $request->validate(['title' => 'required|min:3|max:255', 'content' => 'required|min:5']);
        Article::create([...$v, 'user_id' => Auth::id()]);
        return redirect('/')->with('status', 'Новогодний триумф зафиксирован!');
    }

    public function edit(Article $article) {
        if ($article->user_id !== Auth::id()) abort(403);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article) {
        if ($article->user_id !== Auth::id()) abort(403);
        $v = $request->validate(['title' => 'required', 'content' => 'required']);
        $article->update($v);
        return redirect()->route('articles.show', $article->id)->with('status', 'История изменена.');
    }

    public function destroy(Article $article) {
        if ($article->user_id !== Auth::id()) abort(403);
        $article->delete();
        return redirect('/')->with('status', 'Запись растаяла во тьме.');
    }
}
