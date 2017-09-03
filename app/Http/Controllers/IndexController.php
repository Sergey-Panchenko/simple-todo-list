<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Init default state for app.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        \Auth::logout();
        $user = collect([])->toJson();
        if (\Auth::check()) {
            $user = User::with('projects')->find(\Auth::user()->id)->toJson();
        }
//        dd(\Auth::user());
        return view('todo-list', compact('user'));
    }

}
