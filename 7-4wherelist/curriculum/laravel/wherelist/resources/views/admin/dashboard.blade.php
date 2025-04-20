@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>管理者画面一覧</h2>
        <ul>
            <li><a href="{{ route('admin.users.index') }}">ユーザー管理</a></li>
            <li><a href="{{ route('admin.posts.index') }}">投稿リスト管理</a></li>
            <li><a href="{{ route('admin.area_categories.edit') }}">エリアカテゴリ編集</a></li>
        </ul>
    </div>
@endsection
