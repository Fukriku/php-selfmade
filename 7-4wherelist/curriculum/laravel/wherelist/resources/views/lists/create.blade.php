@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container">
        <h2>リスト作成</h2>

        <form action="{{ route('lists.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">リスト名</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea name="comment" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="url">詳細リンク</label>
                <input type="url" name="url" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">添付画像</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="list_category_id">リストカテゴリ</label>
                <select name="list_category_id" id="list_category_id" class="form-control" required>
                    @if (!empty($categories))
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name ?? 'カテゴリ名未設定' }}</option>
                        @endforeach
                    @else
                        <option value="">カテゴリが登録されていません</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="rating">評価</label>
                <select name="rating" class="form-control">
                    <option value="1">★☆☆</option>
                    <option value="2">★★☆</option>
                    <option value="3">★★★</option>
                </select>
            </div>

            <div class="form-group">
                <label for="list_type">リスト分類</label>
                <select name="list_type" class="form-control">
                    <option value="0">行きたい</option>
                    <option value="1">行った</option>
                </select>
            </div>

            <button class="create_btn btn btn-primary" type="submit">追加</button>
            <div class="button">
                <a href="{{ route('lists.wishlist') }}">戻る</a>
            </div>
        </form>
    </div>
@endsection
