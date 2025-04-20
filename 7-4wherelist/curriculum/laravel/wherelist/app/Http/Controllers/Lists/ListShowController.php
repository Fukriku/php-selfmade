<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListModel;

class ListShowController extends Controller
{
    public function show($id)
    {
        $list = ListModel::findOrFail($id);
        return view('lists.show', compact('list'));
    }
}
