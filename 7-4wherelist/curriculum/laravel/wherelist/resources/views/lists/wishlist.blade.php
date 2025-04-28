@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <div class="container">
        <h2>行きたいリスト</h2>
        <div class="add_btn">
            <a href="{{ route('lists.create') }}" class="btn btn-primary mb-3">＋リスト追加</a>
        </div>
        @if (session('error'))
            <div class="cl-alert alert">
                {{ session('error') }}
            </div>
        @endif

        @foreach ($categories as $category)
            <div class="card mb-4">
                <div class="card-header bg-danger-subtle">
                    {{ $category->name ?? '未設定カテゴリ' }}
                </div>
                <div class="card-body bg-light">
                    @if (!empty($listsByCategory[$category->id]))
                        <div class="row">
                            @foreach ($listsByCategory[$category->id] as $list)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $list->name }}</h5>
                                            <p class="card-text">
                                                評価：
                                                @for ($i = 0; $i < $list->rating; $i++)
                                                    ★
                                                @endfor
                                                @for ($i = $list->rating; $i < 3; $i++)
                                                    ☆
                                                @endfor
                                            </p>
                                            <p class="card-text">{{ $list->comment }}</p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="{{ route('lists.edit', $list->id) }}"
                                                class="btn btn-sm btn-secondary">編集</a>
                                            <a href="{{ route('lists.show', $list->id) }}"
                                                class="btn btn-sm btn-info">詳細</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>このカテゴリに登録されたリストはありません。</p>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="button">
            <a class="" href="{{ route('lists.index') }}">戻る</a>
        </div>
    </div>
@endsection
