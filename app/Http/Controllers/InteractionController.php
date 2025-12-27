<?php
namespace App\Http\Controllers;
use App\Models\{Comment, Rating};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class InteractionController extends Controller {
    public function comment(Request $request) {
        $v = $request->validate(['body' => 'required', 'article_id' => 'required|exists:articles,id', 'parent_id' => 'nullable']);
        Comment::create([...$v, 'user_id' => Auth::id()]);
        return back()->with('status', 'Шепот эльфа записан.');
    }
    public function rate(Request $request) {
        $v = $request->validate(['value' => 'required|integer|min:1|max:5', 'article_id' => 'required']);
        Rating::updateOrCreate(['user_id' => Auth::id(), 'article_id' => $v['article_id']], ['value' => $v['value']]);
        return back()->with('status', 'Твоя оценка принята.');
    }
}
