@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <h2>リスト編集画面</h2>

    <form action="{{ route('lists.update', $list->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
        <input type="hidden" name="return_url" value="{{ url()->previous() }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>リスト名</label>
            <input type="text" name="name" value="{{ $list->name }}" required><br>
        </div>
        <div class="form-group">
            <label>評価</label>
            <select name="rating">
                <option value="1" {{ $list->rating == 1 ? 'selected' : '' }}>★☆☆</option>
                <option value="2" {{ $list->rating == 2 ? 'selected' : '' }}>★★☆</option>
                <option value="3" {{ $list->rating == 3 ? 'selected' : '' }}>★★★</option>
            </select><br>
        </div>
        <div class="form-group">
            <label>コメント</label>
            <textarea id="comment" name="comment" rows="2">{{ old('comment', $list->comment) }}</textarea>
            {{-- <input type="text" name="comment" value="{{ $list->comment }}"><br> --}}
        </div>
        <div class="form-group">
            <label>詳細リンク</label>
            <input type="url" name="url" value="{{ $list->url }}"><br>
        </div>
        <div class="form-group">
            <label>添付画像</label>
            <input type="file" name="image_path"><br>
        </div>
        <div class="form-actions">
            <button type="submit">更新</button>
        </div>

    </form>
    @if ($list->list_type == 0)
        <form method="POST" action="{{ route('lists.markVisited', $list->id) }}" style="display:inline;">
            @csrf
            @method('PUT')
            <div class="form-actions">
                <button type="submit">行った</button>
            </div>

        </form>
    @endif
    <div class="form-actions">
        <button type="submit" onclick="history.back()">戻る</button>
    </div>
@endsection
