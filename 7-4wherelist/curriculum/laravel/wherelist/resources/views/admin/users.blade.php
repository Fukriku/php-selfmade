@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>ユーザー一覧</h2>
        <table>
            <a>ユーザー一覧</a>
            <tr>
                <th>名前</th>
                <th>メール</th>
                <th>管理者</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->admin ? '-🟢-' : '-無-' }}</td>
                    {{-- </tr> --}}
                    <td>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>
                        </form>

                        @if ($user->admin == 0)
                            <form action="{{ route('admin.users.makeAdmin', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit">管理者権限付与</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="{{ route('admin.dashboard') }}">戻る</a>
    </div>
@endsection
