<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListModel;
use App\Models\User;

class PostController extends Controller
{
    // public function index()
    // {
    //     $posts = ListModel::with('user')->get();
    //     return view('admin.posts', compact('posts'));
    // }
    public function index()
    {
        $users = User::with(['lists' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();

        return view('admin.posts', compact('users'));
    }
    public function destroy($id)
    {
        $list = ListModel::findOrFail($id);
        $list->delete();

        return redirect()->route('admin.posts.index')->with('message', '削除しました');
    }
}
