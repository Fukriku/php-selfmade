@extends('layouts.app')

@section('content')
    <h2>リスト編集画面</h2>

    <form action="{{ route('lists.update', $list->id) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="return_url" value="{{ url()->previous() }}">
        @csrf
        @method('PUT')

        <label>リスト名</label>
        <input type="text" name="name" value="{{ $list->name }}" required><br>

        <label>評価</label>
        <select name="rating">
            <option value="1" {{ $list->rating == 1 ? 'selected' : '' }}>★☆☆</option>
            <option value="2" {{ $list->rating == 2 ? 'selected' : '' }}>★★☆</option>
            <option value="3" {{ $list->rating == 3 ? 'selected' : '' }}>★★★</option>
        </select><br>

        <label>コメント</label>
        <input type="text" name="comment" value="{{ $list->comment }}"><br>

        <label>詳細リンク</label>
        <input type="url" name="url" value="{{ $list->url }}"><br>

        <label>添付画像</label>
        <input type="file" name="image_path"><br>

        <button type="submit">更新</button>
    </form>
    @if ($list->list_type == 0)
        <form method="POST" action="{{ route('lists.markVisited', $list->id) }}" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit">行った</button>
        </form>
    @endif
    <button type="submit" onclick="history.back()">戻る</button>
@endsection
