<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListModel;
use App\Models\ListCategory;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $groupId = session('active_group_id');

        $categories = ListCategory::orderBy('id')->get();
        $lists = ListModel::where('group_id', $groupId)
            ->where('list_type', 0) //行きたいリスト
            ->get();

        // カテゴリIDごとのリスト
        $listsByCategory = [];
        foreach ($lists as $list) {
            $listsByCategory[$list->list_category_id][] = $list;
        }
        return view('lists.wishlist', compact('categories', 'listsByCategory'));
    }
}
