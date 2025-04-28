@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

            <button type="submit" class="create_btn btn btn-primary">保存</button>
        </form>
        <div class="button">
            <a href="{{ route('admin.dashboard') }}">戻る</a>
        </div>
    </div>
@endsection
