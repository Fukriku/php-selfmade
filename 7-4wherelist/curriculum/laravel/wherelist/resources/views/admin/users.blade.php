@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container admin-container">
        <table class="table-container">
            <a>ユーザー一覧</a>
            <thead>
                <tr>
                    <th>名前</th>
                    <th>メール</th>
                    <th>管理者</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->admin ? '🟢' : '無' }}</td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('本当に削除してよろしいですか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button>
                            </form>

                            @if ($user->admin == 0)
                                <form action="{{ route('admin.users.makeAdmin', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button class="admin-btn" type="submit">管理者権限付与</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="button">
            <a href="{{ route('admin.dashboard') }}">戻る</a>
        </div>
    </div>
@endsection
