@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container admin-container">
        <h2>ユーザー投稿リスト</h2>
        @foreach ($users as $user)
            <details>
                <summary>{{ $user->name }}</summary>
                <ul>
                    @foreach ($user->lists as $list)
                        <li>
                            {{ $loop->iteration }} {{ $list->name }}
                            {{ $list->comment }}
                            {{ $list->created_at->format('Y/m/d') }}

                            <form method="POST" action="{{ route('admin.posts.delete', $list->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </details>
        @endforeach
        <div class="button">
            <a href="{{ route('admin.dashboard') }}">戻る</a>
        </div>
    </div>
@endsection
