@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container">
        <h2>グループ管理画面</h2>

        {{-- 現在のグループ --}}
        <div>
            <h4 id="toggle-group-list" style="cursor: pointer;">現在のグループ ▼</h4>
            <ul id="group-list" style="display: none;">
                @if (!empty($activeGroup))
                    <p>🔴｢{{ $activeGroup->group_name }}｣にログイン中</p>
                @endif

                {{-- @if (!empty($groups) && count($groups) > 0)
                    @foreach ($groups as $group)
                        <li>
                            <form method="POST" action="{{ route('groups.login') }}">
                                @csrf
                                <input type="hidden" name="group_name" value="{{ $group->group_name }}">
                                <input type="hidden" name="group_password" value="*******">
                                <button type="submit">{{ $group->group_name }} にログイン</button>
                            </form>
                        </li>
                    @endforeach
                @else
                    <li>参加履歴のあるグループはありません</li>
                @endif --}}
            </ul>
        </div>

        {{-- グループメンバー一覧 --}}
        @if (!empty($activeGroup))
            <div>
                <h5>「{{ $activeGroup->group_name }}」のメンバー一覧</h5>
                <ul>
                    @forelse ($members as $member)
                        <li>{{ $member->name }}</li>
                    @empty
                        <li>メンバーがいません</li>
                    @endforelse
                </ul>
            </div>
        @endif

        {{-- グループ作成 --}}
        <div>
            <h4>グループ作成</h4>
            <form class="form-actions" method="POST" action="{{ route('groups.store') }}">
                @csrf
                <input type="text" name="group_name" placeholder="グループ名" required>
                <input type="password" name="group_password" placeholder="パスワード" required>
                <input type="password" name="group_password_confirmation" placeholder="確認" required>
                <div class="form-actions">
                    <button type="submit">作成</button>
                </div>
            </form>
        </div>

        {{-- グループログイン --}}
        <div>
            <h4>グループログイン</h4>
            <form class="form-actions" method="POST" action="{{ route('groups.login') }}">
                @csrf
                <input type="text" name="group_name" placeholder="グループ名" required>
                <input type="password" name="group_password" placeholder="パスワード" required>
                <div class="form-actions">
                    <button type="submit">ログイン</button>
                </div>

            </form>
        </div>
        <div class="button">
            <a href="{{ route('lists.index') }}">戻る</a>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggle-group-list');
        const list = document.getElementById('group-list');
        toggleBtn.addEventListener('click', () => {
            list.style.display = (list.style.display === 'none') ? 'block' : 'none';
        });
    });
</script>
