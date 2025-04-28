@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <body>
        <div class="center-box">
            <div class="form-container">
                <h2>ログイン</h2>
                <form action="{{ route('login') }}" method="POST" class="loginform">
                    @csrf
                    <div class="input_area">
                        <label for="email">メールアドレス</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input_area">
                        <label for="password">パスワード</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="create_btn">ログイン</button>
                    <ul>
                        <li><a href="{{ route('register') }}">新規登録はこちら</a></li>
                        <li><a href="{{ route('password_reset') }}">パスワードをお忘れの方</a></li>
                        <li><a href="{{ route('admin.login') }}">管理者ログイン</a></li>
                    </ul>
                </form>
            </div>
        </div>
    @endsection
