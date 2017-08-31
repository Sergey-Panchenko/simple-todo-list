<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
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
        $user = collect([])->toJson();
        $projects = collect([])->toJson();
        if (\Auth::check()) {
            $user = \Auth::user()->toJson();
            $projects = Project::with('tasks')->where('user_id', \Auth::user()->id)->orderBy('created_at', 'DESC')->get()->toJson();
        }
        return view('index', compact('projects', 'user'));
    }

}
