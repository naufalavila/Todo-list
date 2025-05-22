<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks;


class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Tasks::all());
    }

   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $task = Task::create($request->only(['title', 'description']));

    return response()->json($task, 201);
}


    public function show($id)
    {
        return response()->json(Tasks::findOrFail($id));
    }

    public function update(Request $request, Tasks $tasks)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'deadline' => 'nullable|date',
        'status' => 'nullable|string'
    ]);

    if ($request->has('deadline')) {
        $request->merge([
            'deadline' => date('Y-m-d H:i:s', strtotime($request->deadline))
        ]);
    }

    $tasks->update($request->only(['title', 'description', 'deadline', 'status']));

    return response()->json([
        'message' => 'Task updated successfully.',
        'data' => $tasks
    ], 200);
}



    public function destroy($id)
    {
        Tasks::destroy($id);
        return response()->json(null, 204);
    }
}