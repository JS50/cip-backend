<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(TodoController::class)->group(function (){
    Route::prefix('/todos')->group(function () {
        Route::get('', 'index'); //get all todos
        Route::post('', 'store'); //create new todo
        Route::delete('', 'destroyAll'); //delete all todos

        Route::patch('/{todo}', 'update'); //toggle done of todo
        Route::delete('/{todo}', 'destroy'); //delete a todo
    });

});
