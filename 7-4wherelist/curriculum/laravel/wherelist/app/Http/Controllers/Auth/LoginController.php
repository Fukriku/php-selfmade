<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*ログイン画面を表示*/
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /*ログイン処理*/
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/lists');
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => '入力いただいたメールアドレスで登録がございません'])->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['password' => '正しいパスワードを入力してください'])->withInput();
        }

        return redirect()->intended('lists');
        // return back()->withErrors([
        //     'email' => 'メールアドレスまたはパスワードが違います。',
        // ]);
    }

    /* ログアウト処理*/
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
