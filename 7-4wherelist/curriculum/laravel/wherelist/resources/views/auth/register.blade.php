@extends('layouts.app')

@section('content')
<div class="container">
    <h2>新規登録</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>ユーザー名</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>パスワード</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>パスワード確認</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">登録</button>
        <button type="submit" onclick="history.back()">戻る</button>
    </form>
</div>
@endsection
