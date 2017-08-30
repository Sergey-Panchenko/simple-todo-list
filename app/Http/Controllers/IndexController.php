<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $user = collect([])->toJson();
        $projects = collect([])->toJson();
        if (\Auth::check()) {
            $user = \Auth::user()->toJson();
            $projects = Project::with('tasks')->where('user_id',\Auth::user()->id)->get()->toJson();
        }
        return view('index', compact('projects', 'user'));
    }

    public function deleteProject(Request $request)
    {
        $id = $request->get('id');
        Project::find($id)->delete();
    }

    public function updateProject(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $project = Project::find($id);
        $project->name = $name;
        $project->save();
    }

    public function deleteTask(Request $request)
    {
        $id = $request->get('id');
        Task::find($id)->delete();
    }

    public function updateTask(Request $request)
    {
        $id = $request->get('id');
        $task = Task::find($id);
        $name = $request->get('name');
        $task->name = $name;
        $is_completed = $request->get('is_completed') || 0;
        $task->is_completed = $is_completed;
        $task->save();
    }

    public function createTask(Request $request)
    {
        $name = $request->get('name');
        $project_id = $request->get('project_id');
        $task = new Task();
        $task->name = $name;
        $task->project_id = $project_id;
        $task->position = 0;
        $task->save();
        return $task->toJson();
    }

    public function createProject(Request $request)
    {
        $name = $request->get('projectName');
        $project = new Project();
        $project->name = $name;
        $project->user_id = \Auth::user()->id;
        $project->save();
        $newProject = Project::with('tasks')->find($project->id)->toJson();
        return $newProject;
    }

    public function sortTask(Request $request)
    {
        $newOrder = $request->get('order');

        foreach ($newOrder as $position => $taskId) {
            $task = Task::find($taskId);
            $task->position = $position;
            $task->save();
        }
    }


}
