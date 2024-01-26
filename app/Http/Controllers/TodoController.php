<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
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

    public function store(StoreTodoRequest $request){
        $attributes = $request->validated();

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
