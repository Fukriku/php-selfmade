@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>ログイン</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">ログイン</button>
            <ul>
                <li><a href="{{ route('register') }}">新規登録はこちら</a></li>
                <li><a href="{{ route('password_reset') }}">パスワードをお忘れの方</a></li>
                <li><a href="{{ route('admin.login') }}">管理者ログイン</a></li>
            </ul>
        </form>
    </div>
@endsection
