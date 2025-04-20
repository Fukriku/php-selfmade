<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListModel;

class ListController extends Controller
{
    public function index()
    {
        $wishlist = ListModel::where('list_type', 0)
            ->orderBy('list_category_id')
            ->get()
            ->groupBy('list_category_id');

        $visited = ListModel::where('list_type', 1)
            ->orderBy('list_category_id')
            ->get()
            ->groupBy('list_category_id');

        return view('lists.index', compact('wishlist', 'visited'));
    }
}
