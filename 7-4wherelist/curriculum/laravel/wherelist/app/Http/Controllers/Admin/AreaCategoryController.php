<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListCategory;
use Illuminate\Http\Request;

class AreaCategoryController extends Controller
{
    public function edit()
    {
        // ID 1〜3 を確保（なければ追加）
        for ($i = 1; $i <= 3; $i++) {
            \App\Models\ListCategory::firstOrCreate(['id' => $i], ['name' => "エリアカテゴリ {$i}"]);
        }

        $categories = \App\Models\ListCategory::orderBy('id')->limit(3)->get();
        return view('admin.area_categories', compact('categories'));
    }

    public function update(Request $request)
    {
        $names = $request->input('names', []);

        foreach ($names as $index => $name) {
            $category = ListCategory::skip($index)->first();
            if ($category) {
                $category->update(['name' => $name]);
            }
        }

        return redirect()->route('admin.area_categories.edit')->with('success', 'エリアカテゴリを更新しました');
    }
}
