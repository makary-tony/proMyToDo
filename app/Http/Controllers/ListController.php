<?php

namespace App\Http\Controllers;

use App\TodoList;

class ListController extends Controller
{
    /**
     * Display the list page.
     *
     * @param TodoList $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(TodoList $list)
    {
        return view('list', compact('list'));
    }
}
