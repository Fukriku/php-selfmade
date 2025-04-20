<?php


namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ユーザーが所属しているグループを取得
        $groups = $user->groups ?? [];

        // 現在のグループを取得
        $activeGroupId = session('active_group_id');
        $activeGroup = Group::with('users')->find($activeGroupId);
        $members = $activeGroup?->users ?? [];

        // メンバー一覧
        $members = [];

        return view('lists.groups', compact('groups', 'activeGroup', 'members'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255|unique:groups,group_name',
            'group_password' => 'required|string|min:4|confirmed',
        ]);

        $group = new Group();
        $group->group_name = $request->group_name;
        $group->password = Hash::make($request->group_password);
        $group->owner_id = Auth::id();
        $group->save();

        // ユーザーとグループの紐づけ
        $group->users()->attach(Auth::id());

        // セッションにログイン状態を保持
        session(['group_id' => $group->id]);
        session(['active_group_id' => $group->id]);

        return redirect()->route('groups.index')->with('message', 'グループを作成しました');
    }

    public function login(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string',
            'group_password' => 'required|string',
        ]);

        $group = Group::where('group_name', $request->group_name)->first();

        if (!$group || !Hash::check($request->group_password, $group->password)) {
            return back()->withErrors(['group_name' => 'グループ名またはパスワードが違います']);
        }

        // グループとユーザーの関連付け
        if (!$group->users->contains(Auth::id())) {
            $group->users()->attach(Auth::id());
        }

        session(['group_id' => $group->id]);
        session(['active_group_id' => $group->id]);

        return redirect()->route('groups.index')->with('message', 'グループにログインしました');
    }
}
