@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container form-container">
        <h2>管理者ログイン</h2>
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="input_area">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input_area">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit" class="create_btn btn btn-primary">ログイン</button>
            <div class="button">
                <a href="{{ route('login') }}">戻る</a>
            </div>

        </form>
    </div>
@endsection
