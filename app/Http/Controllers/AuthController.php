<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
class AuthController extends Controller {
    public function register(Request $request) {
        $v = $request->validate(['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|confirmed', 'avatar' => 'nullable|image']);
        if ($request->hasFile('avatar')) $v['avatar'] = $request->file('avatar')->store('avatars', 'public');
        Auth::login(User::create([...$v, 'password' => Hash::make($v['password'])]));
        return redirect('/')->with('status', 'Ты стал частью Новогоднего Триумфа 2025!');
    }
    public function login(Request $request) {
        if (Auth::attempt($request->only('email', 'password'))) return redirect('/');
        return back()->withErrors(['email' => 'Вьюга преградила путь. Неверные данные.']);
    }
    public function logout() { Auth::logout(); return redirect('/'); }
}
