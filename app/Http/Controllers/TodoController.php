<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use DateTime;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index() {
        $todos = Todos::all()->toArray();

        // Sort the todos by date created at
        usort($todos, function($a, $b) {
            $a = new DateTime($a['created_at']);
            $b = new DateTime($b['created_at']);
            if ($a == $b) return 0;
            return $a < $b ? -1 : 1;
        });
        return response()->json($todos);
    }

    public function store(Request $request) {
        if (is_null($request->task) || is_null($request->completed)) {
            return response()->json([
                "message" => "Error: Missing task or completed"
            ], 404);
        }
        
        $todo = new Todos;
        $todo->task = $request->task;
        $todo->completed = $request->completed;
        $todo->save();
        return response()->json([
            "message" => "Todo Added",
            "request" => $request,
            "id" => $todo->id,
        ], 201);
    }

    public function delete($id) {
        if (!Todos::where('id', $id)->exists()) {
            return response()->json([
                "message" => "Todo not found."
            ], 404);
        }

        $todo = Todos::find($id);
        $todo->delete();

        return response()->json([
            "message" => "Todo delete."
        ], 202);
    }

    // Gets a single todo based on id
    public function get($id) {
        if (!Todos::where('id', $id)->exists()) {
            return response()->json([
                "message" => "Todo not found."
            ], 404);
        }

        $todo = Todos::find($id);
        return response()->json($todo);
    }

    // Delete all completed tasks
    public function deleteAllCompleted() {
        $todos = array_filter(Todos::all()->toArray(), fn ($t) => $t['completed'] === 1);

        if (count($todos) === 0) {
            return response()->json([
                "message" => "No completed todos to delete."
            ], 400); 
        }
        
        foreach ($todos as $todo) {
            $todo = Todos::find($todo['id']);
            $todo->delete();
        }

        return response()->json([
            "message" => "Deleted all completed todos."
        ], 202);
    }

    // Update the completed value of a todo
    public function update(Request $request, $id) {
        if (!Todos::where('id', $id)->exists()) {
            return response()->json([
                "message" => "Todo not found."
            ], 404);
        }

        if (is_null($request->completed)) {
            return response()->json([
                "message" => "Missing completed property in request.",
                "request" => $request
            ], 400);
        }

        $todo = Todos::find($id);
        $todo->completed = $request->completed;
        $todo->save();

        return response()->json([
            "message" => "Todo Updated.",
            "completed" => $todo->completed,
            "request" => $request
        ], 201);
    }
}
