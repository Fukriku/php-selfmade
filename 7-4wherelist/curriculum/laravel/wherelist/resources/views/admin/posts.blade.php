@extends('layouts.app')

@section('content')
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
    {{-- <h2>リスト管理</h2>
    <table>
        <tr>
            <th>リスト名</th>
            <th>投稿者</th>
            <th>評価</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->name }}</td>
                <td>{{ $post->user->name ?? '不明' }}</td>
                <td>{{ $post->rating }}</td>
            </tr>
        @endforeach
    </table> --}}
    <a href="{{ route('admin.dashboard') }}">戻る</a>
@endsection
