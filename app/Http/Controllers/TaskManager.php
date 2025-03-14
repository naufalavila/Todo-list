<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskManager extends Controller
{
    function listTask() {
        $uncompletedTasks = Tasks::where('status', 'uncompleted')->get();
        $completedTasks = Tasks::where('status', 'completed')->get();
        return view("welcome", compact('uncompletedTasks', 'completedTasks'));                    
    }

    function addTask() 
    {
        return view('tasks.add');
    }

    function addTaskPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deadline' => 'required|date',
            'description' => 'required'
        ]);

        $task = new Tasks();
        $task->title = $request->title;
        $task->deadline = $request->deadline;
        $task->description = $request->description;
        $task->status = 'uncompleted';

        if($task->save()) {
            return redirect(route("home"))
            ->with("success", "Task added successfully!");
        }
        return redirect(route("task.add"))
        ->with("error", "Task cannot be added.");
    }

    function editTask($id)
    {
        $task = Tasks::findOrFail($id);
        return view("tasks.edit", compact("task"));
    }

    function updateTask(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'deadline' => 'required|date',
            'description' => 'required'
        ]);

        $task = Tasks::findOrFail($id);
        $task->title = $request->title;
        $task->deadline = $request->deadline;
        $task->description = $request->description;

        if ($task->save()) {
            return redirect(route("home"))->with("success", "Task updated successfully!");
        }
        return redirect(route("task.edit", ['id' => $id]))
        ->with("error", "Task update failed.");
    }

    function updateTaskStatus($id)
    {
        if(Tasks::where('id', $id)->update(['status' => "completed"])) {
            return redirect(route("home"))->with("success", "Task completed");
        }
        return redirect(route("home"))->with("error", "Error occurred, try again");
    }

    function deleteTask($id)
    {
        if(Tasks::where('id', $id)->delete()) {
            return redirect(route("home"))->with("success", "Task deleted");
        }
        return redirect(route("home"))->with("error", "Error occurred, try again");
    }
}
