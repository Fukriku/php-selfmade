@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <h2>リスト詳細</h2>

    <p><strong>リスト名：</strong>{{ $list->name }}</p>

    <p><strong>評価：</strong>
        @for ($i = 1; $i <= 3; $i++)
            {{ $i <= $list->rating ? '★' : '☆' }}
        @endfor
    </p>

    <p><strong>コメント：</strong>{{ $list->comment }}</p>

    @if ($list->url)
        <p><strong>詳細リンク：</strong><a href="{{ $list->url }}" target="_blank">{{ $list->url }}</a></p>
    @endif

    @if ($list->image_path)
        <p><strong>画像：</strong><br>
            {{-- <img src="{{ asset('storage/' . $list->image_path) }}" alt="画像" style="max-width: 200px;"> --}}
            @if (!empty($list->image_path))
                <img src="{{ asset('storage/images/' . $list->image_path) }}" alt="画像" style="max-width: 200px;">
            @endif
        </p>
    @endif
    <button type="submit" onclick="history.back()" class="create_btn btn btn-primary">戻る</button>
@endsection
