@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container admin-container">
        <h2>管理者画面一覧</h2>
        <ul>
            <li class="admin-menu"><a class="adomin-index" href="{{ route('admin.users.index') }}">ユーザー管理</a></li>
            <li class="admin-menu"><a class="adomin-index" href="{{ route('admin.posts.index') }}">投稿リスト管理</a></li>
            <li class="admin-menu"><a class="adomin-index" href="{{ route('admin.area_categories.edit') }}">エリアカテゴリ編集</a>
            </li>
        </ul>
    </div>
@endsection
