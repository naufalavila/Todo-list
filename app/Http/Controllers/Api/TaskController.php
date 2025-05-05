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
        $task = Tasks::create($request->only(['title', 'deadline', 'description', 'status']));
        return response()->json($task, 201);
    }

    public function show($id)
    {
        return response()->json(Tasks::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);
        $task->update($request->only(['title', 'deadline', 'description', 'status']));
        return response()->json($task);
    }

    public function destroy($id)
    {
        Tasks::destroy($id);
        return response()->json(null, 204);
    }
}

