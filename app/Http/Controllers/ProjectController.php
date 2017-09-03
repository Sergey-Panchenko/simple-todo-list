<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Create new project.
     *
     * @param Request $request
     *
     * @return string
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'projectName' => 'required|string',
        ]);
        $name = $request->get('projectName');
        $project = new Project();
        $project->name = $name;
        $project->user_id = \Auth::user()->id;
        $project->save();
        $newProject = Project::with('tasks')->find($project->id)->toJson();
        return $newProject;
    }

    /**
     * Update project.
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        $id = $request->get('id');
        $name = $request->get('name');
        $project = Project::find($id);
        $project->name = $name;
        $project->save();
    }

    /**
     * Delete project.
     *
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        Project::find($id)->delete();
    }
}
