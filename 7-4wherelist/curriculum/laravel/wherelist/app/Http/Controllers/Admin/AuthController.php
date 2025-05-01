<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (Auth::attempt($credentials)) {

            if (Auth::user()->admin === 1) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => '管理者ではありません']);
            }
        }

        if (!$user) {
            return back()->withErrors(['email' => '入力いただいたメールアドレスで登録がございません'])->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['password' => '正しいパスワードを入力してください'])->withInput();
        }

        // return back()->withErrors(['email' => 'ログイン情報が正しくありません']);
    }
}
