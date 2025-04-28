@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="form-container">
        <h2>ユーザー登録</h2>
        <form action="{{ route('password_reset') }}" method="POST">
            @csrf
            <div class="input_area">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input_area">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input_area">
                <label for="password">パスワード確認</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="create_btn">登録</button>
            <div class="button">
                <a href="{{ route('login') }}">戻る</a>
            </div>
        </form>
    </div>
@endsection
