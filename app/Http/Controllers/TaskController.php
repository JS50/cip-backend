<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all tasks from the database and return as JSON
        $tasks = Task::all();
        return response()->json($tasks);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'task' => 'required|string|max:255', // Ensure 'task' is a non-empty string
            'completed' => 'required|boolean',  // Ensure 'completed' is a boolean
        ]);

        // Create a new Task instance and save it to the database
        $task = new Task();
        $task->task = $request->task;           // Set task name
        $task->completed = $request->completed; // Set completed status
        $task->save();

        // Return the created task with a 201 (Created) status
        return response()->json($task, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);

        if(!$task){
            return response()->json(['message' => 'task not found'], 404);
        }
        return response()->json($task);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Task::where('id', $id)->exists()) {
            $task = Task::find($id);

            // Update only the 'completed' field if it's present in the request
            if ($request->has('completed')) {
                $task->completed = $request->completed;
            }

            $task->save();

            return response()->json(["message" => "Task updated successful"], 200);
        } else {
            return response()->json(['message' => 'task not found'], 404);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Task::where('id', $id)->exists()) {
            $task = Task::find($id);
            $task->delete();

            return response()->json(['message' => 'task deleted successfully'], 200);
        } else{
            return response()->json(['message' => 'task not found'], 404);
        }
    }


    public function destroyAll(){
        Task::truncate();
        return response()->json(['message' => 'tasks deleted successfully'], 200);

    }
}
