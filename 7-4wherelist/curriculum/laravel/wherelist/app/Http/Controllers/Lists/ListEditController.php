<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListModel;
use Illuminate\Support\Facades\Auth;

class ListEditController extends Controller
{
    public function edit($id)
    {
        $list = ListModel::findOrFail($id);
        return view('lists.edit', compact('list'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'url' => 'nullable|url',
            'rating' => 'nullable|integer|min:1|max:3',
            'image_path' => 'nullable|image',
        ]);

        $list = ListModel::findOrFail($id);
        $list->name = $validated['name'];
        $list->comment = $validated['comment'] ?? null;
        $list->url = $validated['url'] ?? null;


        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('images', 'public');
            $validated['image_path'] = basename($path);
        }
        $list->update($validated);
        $list->save();

        $redirectUrl = $request->input('return_url', route('lists.wishlist'));

        return redirect($redirectUrl)->with('success', 'リストを更新しました');
    }

    public function markVisited($id)
    {
        $list = ListModel::findOrFail($id);

        $list->list_type = 1;
        $list->save();

        return redirect()->route('lists.wishlist')->with('message', '行ったリストに移動しました');
    }
}
