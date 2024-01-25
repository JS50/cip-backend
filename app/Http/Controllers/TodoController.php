<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TodoController extends Controller
{
    public function index(){
        return response(Todo::query()
            ->latest('created_at')
            ->get()
        );
    }

    public function store(){
        $attributes = request()->validate([
            'task' => 'required',
            'done' => 'required'
        ]);
        $newTodo = Todo::create($attributes);
        return response($newTodo);
    }
    public function destroyAll(){
        DB::table('todos')->delete();
        return response('success');
    }
    public function destroy(Todo $todo){
        $todo->delete();
        return response('success');
    }
    public function update(Todo $todo){
        $todo->done = !$todo->done;
        $todo->save();
        return response('success');
    }

}
