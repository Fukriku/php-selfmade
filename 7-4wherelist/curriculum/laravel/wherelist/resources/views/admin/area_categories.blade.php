@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>エリアカテゴリ編集画面</h2>

        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.area_categories.update') }}" method="POST">
            @csrf

            @foreach ($categories as $index => $category)
                <div style="margin-bottom: 1rem;">
                    <label>エリア{{ $index + 1 }}</label>
                    <input type="text" name="names[]" value="{{ old('names.' . $index, $category->name) }}" placeholder="入力"
                        required>
                </div>
            @endforeach

            <button type="submit">保存</button>
        </form>
        <a href="{{ route('admin.dashboard') }}">戻る</a>
    </div>
@endsection
