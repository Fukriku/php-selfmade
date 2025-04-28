@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="form-container">
        <h2>新規登録</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input_area">
                <label>メールアドレス</label>
                <input type="email" name="email" required>
            </div>

            <div class="input_area">
                <label>ユーザー名</label>
                <input type="text" name="name" required>
            </div>

            <div class="input_area">
                <label>パスワード</label>
                <input type="password" name="password" required>
            </div>

            <div class="input_area">
                <label>パスワード確認</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="create_btn">登録</button>
            <div class="button">
                <a href="{{ route('login') }}">戻る</a>
            </div>
        </form>
    </div>
@endsection
