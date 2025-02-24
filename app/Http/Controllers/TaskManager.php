<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskManager extends Controller
{
    function listTask() {
        $tasks = Tasks::where('status', NULL)->get();
        return view("welcome", compact('tasks'));                    
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

        if($task->save()) {
            return redirect (route("home"))
            ->with("success", "task added successfully!");
        }
        return redirect(route("task.add"))
        ->with("error", "task cannot be added.");
    }

    function updateTaskStatus($id)
    {
        if(Tasks::where('id', $id)->update(['status' => "completed"]))
        {
            return redirect(route("home"))->with("sucess", "Task completed");
        }
        return redirect(route("home"))->with("error", "Error occured, tryagain");
    }

    function deleteTask($id)
    {
        if(Tasks::where('id', $id)->delete())
        {
            return redirect(route("home"))->with("sucess", "Task deleted");
        }
        return redirect(route("home"))->with("error", "Error occured, tryagain");
    }
}
