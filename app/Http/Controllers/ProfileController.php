<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, Storage};
class ProfileController extends Controller {
    public function edit() { return view('profile.edit', ['user' => Auth::user()]); }
    public function update(Request $request) {
        $user = Auth::user();
        $v = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('avatar')) {
            if ($user->avatar) Storage::disk('public')->delete($user->avatar);
            $v['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        if ($request->filled('password')) $v['password'] = Hash::make($v['password']);
        else unset($v['password']);
        $user->update($v);
        return back()->with('status', 'Твой лик в зеркале вечности изменен!');
    }
}
