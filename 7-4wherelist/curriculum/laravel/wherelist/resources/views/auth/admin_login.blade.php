@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>管理者ログイン</h2>
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div>
                <label for="name">名前</label>
                <input id="name" type="text" name="name" required>
            </div>
            <div>
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit">ログイン</button>
            <a href="{{ route('login') }}">戻る</a>

        </form>
    </div>
@endsection
