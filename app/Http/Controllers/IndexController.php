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
        if (\Auth::check()) {
            $user = \Auth::user()->with('projects')->first()->toJson();
//            dd($user);
        }
        return view('index', compact('user'));
    }

}
