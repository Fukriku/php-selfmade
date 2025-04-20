<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->admin = 1;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', '管理者権限を付与しました。');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // 論理削除（SoftDeletesが有効な前提）

        return redirect()->route('admin.users.index')->with('success', 'ユーザーを削除しました。');
    }
}
