<?php

// namespace App\Http\Controllers\Lists;

// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
// use App\Models\ListModel;
// use App\Models\ListCategory;

// class ListIndexController extends Controller
// {
//     public function index()
//     {
//         $userId = Auth::id();

//         // 全データをlist_typeで分ける
//         $categories = ListCategory::all();

//         $lists = ListModel::with('category')
//             ->where('user_id', $userId)
//             ->get()
//             ->groupBy(function ($item) {
//                 return $item->list_type . '_' . $item->list_category_id;
//             });

//         return view('lists.index', compact('lists', 'categories'));
//     }
// }

namespace App\Http\Controllers\Lists;

use App\Models\Group;
use App\Models\ListCategory;
use App\Models\ListModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ListIndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $groupId = session('active_group_id');
        $activeGroup = $groupId ? Group::find($groupId) : null;

        // カテゴリ取得
        $categories = ListCategory::orderBy('id')->get();

        // $listsRaw = ListModel::where(...)->get(); // ← group_idまたはuser_idで条件分岐済み
        // $lists = [];
        // foreach ($listsRaw as $list) {
        //     $key = $list->list_type . '_' . $list->list_category_id;
        //     $lists[$key][] = $list;
        // }

        $lists = ListModel::query()
            ->when($groupId, function ($query) use ($groupId) {
                return $query->where('group_id', $groupId);
            }, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->get()
            ->groupBy(function ($item) {
                return $item->list_type . '_' . $item->list_category_id;
            });

        return view('lists.index', compact('lists',  'categories', 'activeGroup'));
    }
}
