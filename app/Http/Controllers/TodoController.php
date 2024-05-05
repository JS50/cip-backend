<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index() {
        $todos = Todos::all();
        return response()->json($todos);
    }

    public function store(Request $request) {
        $todo = new Todos;
        $todo->task = $request->task;
        $todo->completed = $request->completed;
        $todo->save();
        return response()->json([
            "message" => "Todo Added."
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
            ], 404); 
        }
        
        foreach ($todos as $todo) {
            $todo = Todos::find($todo['id']);
            $todo->delete();
        }

        return response()->json([
            "message" => "Deleted all completed todos."
        ], 202);
    }
    
}
