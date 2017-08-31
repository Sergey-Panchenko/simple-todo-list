<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Create new task in some project.
     *
     * @param Request $request
     *
     * @return string
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'project_id' => 'required',
            'deadline' => 'required',
        ]);
        $name = $request->get('name');
        $project_id = $request->get('project_id');
        $deadline = $request->get('deadline');
        $task = new Task();
        $task->name = $name;
        $task->deadline = $deadline;
        $task->project_id = $project_id;
        $task->position = 0;
        $task->save();
        return $task->toJson();
    }

    /**
     * Update existing task.
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $task = Task::find($id);
        $name = $request->get('name');
        $deadline = $request->get('deadline');
        $task->name = $name;
        $task->deadline = $deadline;
        $is_completed = $request->get('is_completed') || 0;
        $task->is_completed = $is_completed;
        $task->save();
    }

    /**
     * Delete task from project.
     *
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        Task::find($id)->delete();
    }

    /**
     * Sort tasks in project.
     *
     * @param Request $request
     */
    public function sort(Request $request)
    {
        $newOrder = $request->get('order');

        foreach ($newOrder as $position => $taskId) {
            $task = Task::find($taskId);
            $task->position = $position;
            $task->save();
        }
    }

}
