<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListModel;
use App\Models\ListCategory;
use Illuminate\Support\Facades\Auth;

class ListCreateController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $groupId = session('active_group_id');
        if (!$groupId) {
            return redirect()->route('lists.wishlist')->with('error', 'グループにログインしてください');
        }

        // list_type=0　デフォルト
        $list_type = 0;
        // list_categories 取得3件
        $categories = ListCategory::orderBy('id')->limit(3)->get();

        return view('lists.create', compact('user', 'groupId', 'list_type', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'url' => 'nullable|url',
            'list_category_id' => 'required|exists:list_categories,id',
            'rating' => 'nullable|integer',
            'image_path' => 'nullable|image',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['group_id'] = session('active_group_id');
        $validated['list_type'] = 0;


        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('images' . 'public'); //publicディスクのimagesフォルダに保存
            $validated['image_path'] = basename($path);
        }

        ListModel::create($validated);

        return redirect()->route('lists.wishlist')->with('success', 'リストを追加しました');
    }
}
