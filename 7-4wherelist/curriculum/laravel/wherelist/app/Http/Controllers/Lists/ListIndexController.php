<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ListModel;
use App\Models\ListCategory;

class ListIndexController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 全データをlist_typeで分ける
        $categories = ListCategory::all();

        $lists = ListModel::with('category')
            ->where('user_id', $userId)
            ->get()
            ->groupBy(function ($item) {
                return $item->list_type . '_' . $item->list_category_id;
            });

        return view('lists.index', compact('lists', 'categories'));
    }
}
