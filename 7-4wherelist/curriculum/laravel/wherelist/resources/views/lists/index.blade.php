@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>一覧画面</h2>
        <div class="d-flex mb-4">
            <a href="{{ route('groups.index') }}" class="btn btn-secondary me-2">グループ管理</a>
        </div>

        <h3>
            <a href="{{ route('lists.wishlist') }}">行きたいリスト</a>
        </h3>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="p-2 bg-danger-subtle text-center">
                        {{ $category->name }}
                    </div>
                    <div class="border p-2" style="min-height: 100px;">
                        @foreach ($lists['0_' . $category->id] ?? [] as $list)
                            <div>{{ $list->name }}</div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <h3 class="mt-5">
            <a href="{{ route('lists.visited') }}">行ったリスト</a>
        </h3>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="p-2 bg-primary-subtle text-center">
                        {{ $category->name }}
                    </div>
                    <div class="border p-2" style="min-height: 100px;">
                        @foreach ($lists['1_' . $category->id] ?? [] as $list)
                            <div>{{ $list->name }}</div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
