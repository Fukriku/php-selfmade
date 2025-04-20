@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ユーザー登録</h2>
    <form action="{{ route('password_reset') }}" method="POST">
        @csrf
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password">パスワード確認</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">登録</button>
        <button type="submit" onclick="history.back()">戻る</button>
    </form>
</div>
@endsection
